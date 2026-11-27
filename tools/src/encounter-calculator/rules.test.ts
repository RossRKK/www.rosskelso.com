import { describe, expect, it } from "vitest";
import { awardPerCharacter, creatureXp, encounterBudgets, isOffTable, rateEncounter, type Threat } from "./rules";

const budgetsFor = (partySize: number): Record<Threat, number> =>
  Object.fromEntries(encounterBudgets(partySize).map(({ threat, xp }) => [threat, xp])) as Record<Threat, number>;

describe("encounterBudgets", () => {
  it("matches Table 10-1 for four characters", () => {
    expect(budgetsFor(4)).toEqual({ trivial: 40, low: 60, moderate: 80, severe: 120, extreme: 160 });
  });

  it.each([
    // As written, low's adjustment of 20 takes it to or below trivial under three characters.
    [1, { trivial: 10, low: 0, moderate: 20, severe: 30, extreme: 40 }],
    [2, { trivial: 20, low: 20, moderate: 40, severe: 60, extreme: 80 }],
    [3, { trivial: 30, low: 40, moderate: 60, severe: 90, extreme: 120 }],
    [5, { trivial: 50, low: 80, moderate: 100, severe: 150, extreme: 200 }],
    [6, { trivial: 60, low: 100, moderate: 120, severe: 180, extreme: 240 }],
  ])("applies the character adjustment for a party of %i", (size, expected) => {
    expect(budgetsFor(size)).toEqual(expected);
  });
});

describe("creatureXp", () => {
  it.each([
    [-4, 10], [-3, 15], [-2, 20], [-1, 30], [0, 40], [1, 60], [2, 80], [3, 120], [4, 160],
  ])("matches Table 10-2 at party level %+i", (difference, xp) => {
    expect(creatureXp(difference)).toBe(xp);
    expect(isOffTable(difference)).toBe(false);
  });

  it.each([[-7, 10], [-5, 10], [5, 160], [9, 160]])("counts %+i as the nearest end of the table", (difference, xp) => {
    expect(creatureXp(difference)).toBe(xp);
    expect(isOffTable(difference)).toBe(true);
  });
});

describe("rateEncounter", () => {
  const party = { size: 4, level: 5 };

  it("rates an empty encounter as trivial", () => {
    expect(rateEncounter(party, [])).toMatchObject({ xp: 0, rating: "trivial" });
  });

  it.each([
    // A budget is a ceiling: exactly on it is that threat, one over is the next.
    [[{ count: 1, level: 5 }], 40, "trivial"],
    [[{ count: 1, level: 5 }, { count: 1, level: 1 }], 50, "low"],
    [[{ count: 1, level: 6 }], 60, "low"],
    [[{ count: 2, level: 5 }], 80, "moderate"],
    // The GM Core "boss and lackeys" group: one +2 and four -4 creatures, 120 XP.
    [[{ count: 1, level: 7 }, { count: 4, level: 1 }], 120, "severe"],
    [[{ count: 1, level: 9 }], 160, "extreme"],
    [[{ count: 1, level: 9 }, { count: 1, level: 1 }], 170, "beyond-extreme"],
  ] as const)("rates %j as %i XP", (groups, xp, rating) => {
    expect(rateEncounter(party, [...groups])).toMatchObject({ xp, rating });
  });

  it("never rates a party of one or two as low", () => {
    expect(rateEncounter({ size: 1, level: 3 }, [{ count: 1, level: 0 }])).toMatchObject({ xp: 15, rating: "moderate" });
    expect(rateEncounter({ size: 2, level: 3 }, [{ count: 1, level: 1 }])).toMatchObject({ xp: 20, rating: "trivial" });
    expect(rateEncounter({ size: 2, level: 3 }, [{ count: 1, level: 2 }])).toMatchObject({ xp: 30, rating: "moderate" });
  });

  it("scales the rating with party size", () => {
    expect(rateEncounter({ size: 6, level: 5 }, [{ count: 2, level: 5 }]).rating).toBe("low");
  });
});

describe("awardPerCharacter", () => {
  it.each([
    [4, 130, 130],
    // A moderate encounter for six (120 XP) awards moderate for four (80 XP).
    [6, 120, 80],
    [2, 40, 80],
    [3, 130, 173],
  ])("gives a party of %i facing %i XP %i XP each", (size, xp, award) => {
    expect(awardPerCharacter(size, xp)).toBe(award);
  });
});
