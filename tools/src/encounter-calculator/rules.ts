// Encounter building from Pathfinder 2e GM Core, "Building Encounters":
// https://2e.aonprd.com/Rules.aspx?ID=2716

export const THREATS = ["trivial", "low", "moderate", "severe", "extreme"] as const;
export type Threat = (typeof THREATS)[number];

// The rating an encounter reads as: the smallest threat whose budget it fits in.
export type Rating = Threat | "beyond-extreme";

export interface Party {
  size: number;
  level: number;
}

export interface CreatureGroup {
  count: number;
  level: number;
}

export interface Budget {
  threat: Threat;
  xp: number;
}

export interface Encounter {
  xp: number;
  rating: Rating;
  budgets: Budget[];
}

export function rateEncounter(party: Party, groups: CreatureGroup[]): Encounter {
  const xp = groups.reduce((sum, group) => sum + groupXp(party, group), 0);
  const budgets = encounterBudgets(party.size);
  const fits = budgets.find((budget) => xp <= budget.xp);
  return { xp, rating: fits?.threat ?? "beyond-extreme", budgets };
}

export function groupXp(party: Party, group: CreatureGroup): number {
  return group.count * creatureXp(group.level - party.level);
}

// Table 10-1. The rules state each budget for four characters, with an
// adjustment per character above or below four.
const ENCOUNTER_BUDGET: Record<Threat, { forFour: number; perCharacter: number }> = {
  trivial: { forFour: 40, perCharacter: 10 },
  low: { forFour: 60, perCharacter: 20 },
  moderate: { forFour: 80, perCharacter: 20 },
  severe: { forFour: 120, perCharacter: 30 },
  extreme: { forFour: 160, perCharacter: 40 },
};

export function encounterBudgets(partySize: number): Budget[] {
  return THREATS.map((threat) => {
    const { forFour, perCharacter } = ENCOUNTER_BUDGET[threat];
    return { threat, xp: forFour + (partySize - 4) * perCharacter };
  });
}

// Table 10-2, indexed by creature level minus party level, from -4 to +4.
const CREATURE_XP = [10, 15, 20, 30, 40, 60, 80, 120, 160] as const;
export const LEVEL_DIFFERENCE_RANGE = { min: -4, max: 4 } as const;

// The table stops at four levels either side; beyond it a creature counts as the nearest end.
export function creatureXp(levelDifference: number): number {
  const { min, max } = LEVEL_DIFFERENCE_RANGE;
  const clamped = Math.min(max, Math.max(min, levelDifference));
  return CREATURE_XP[clamped - min]!;
}

export function isOffTable(levelDifference: number): boolean {
  return levelDifference < LEVEL_DIFFERENCE_RANGE.min || levelDifference > LEVEL_DIFFERENCE_RANGE.max;
}
