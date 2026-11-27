import { describe, expect, it } from "vitest";
import { creatureXp, encounterBudgets, isOffTable, rateEncounter, type Threat } from "./rules";

const budgetsFor = (partySize: number): Record<Threat, number> =>
  Object.fromEntries(encounterBudgets(partySize).map(({ threat, xp }) => [threat, xp])) as Record<Threat, number>;

describe("encounterBudgets", () => {
  it("matches Table 10-1 for four characters", () => {
    expect(budgetsFor(4)).toEqual({ trivial: 40, low: 60, moderate: 80, severe: 120, extreme: 160 });
  });

  it.each([
    [1, { trivial: 10, low: 15, moderate: 20, severe: 30, extreme: 40 }],
    [3, { trivial: 30, low: 45, moderate: 60, severe: 90, extreme: 120 }],
    [5, { trivial: 50, low: 75, moderate: 100, severe: 150, extreme: 200 }],
    [6, { trivial: 60, low: 90, moderate: 120, severe: 180, extreme: 240 }],
  ])("applies the character adjustment for a party of %i", (size, expected) => {
    expect(budgetsFor(size)).toEqual(expected);
  });

  it("keeps the threats in increasing order for every party size", () => {
    for (let size = 1; size <= 10; size++) {
      const xps = encounterBudgets(size).map((budget) => budget.xp);
      expect(xps).toEqual([...xps].sort((a, b) => a - b));
      expect(new Set(xps).size).toBe(xps.length);
    }
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

  it("scales the rating with party size", () => {
    expect(rateEncounter({ size: 6, level: 5 }, [{ count: 2, level: 5 }]).rating).toBe("low");
  });
});
