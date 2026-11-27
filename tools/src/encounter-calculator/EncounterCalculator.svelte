<script lang="ts">
  import IntegerInput from "./IntegerInput.svelte";
  import ThreatBar from "./ThreatBar.svelte";
  import { groupXp, isOffTable, rateEncounter, type CreatureGroup, type Party } from "./rules";

  // Creature levels run from -1 (the weakest in the bestiaries) to 25.
  const CREATURE_LEVELS = { min: -1, max: 25 };

  interface Row extends CreatureGroup {
    id: number;
  }

  let party: Party = $state({ size: 4, level: 1 });
  let nextId = 0;
  let rows: Row[] = $state([newRow(1)]);
  let encounter = $derived(rateEncounter(party, rows));

  function newRow(level: number): Row {
    return { id: nextId++, count: 1, level };
  }

  function addRow() {
    rows.push(newRow(rows.at(-1)?.level ?? party.level));
  }

  function removeRow(id: number) {
    rows = rows.filter((row) => row.id !== id);
  }
</script>

<form class="encounter-calculator" onsubmit={(event) => event.preventDefault()}>
  <fieldset>
    <legend>Party</legend>
    <p class="line">
      <IntegerInput label="Party size" min={1} max={12} value={party.size} onchange={(size) => (party.size = size)} />
      characters of level
      <IntegerInput label="Party level" min={1} max={20} value={party.level} onchange={(level) => (party.level = level)} />
    </p>
  </fieldset>

  <fieldset>
    <legend>Creatures</legend>
    {#each rows as row, i (row.id)}
      {@const difference = row.level - party.level}
      <p class="line">
        <IntegerInput label="Creature group {i + 1} count" min={1} max={99} value={row.count} onchange={(count) => (row.count = count)} />
        of level
        <IntegerInput label="Creature group {i + 1} level" {...CREATURE_LEVELS} value={row.level} onchange={(level) => (row.level = level)} />
        <span class="xp">{groupXp(party, row)} XP</span>
        <button type="button" class="remove" aria-label="Remove creature group {i + 1}" onclick={() => removeRow(row.id)}>×</button>
        {#if isOffTable(difference)}
          <span class="warning">
            {Math.abs(difference)} levels {difference > 0 ? "above" : "below"} the party is off the XP table; counted as {difference > 0 ? "+4" : "-4"}
          </span>
        {/if}
      </p>
    {/each}
    <button type="button" class="add" onclick={addRow}>+ Add creatures</button>
  </fieldset>

  <ThreatBar {encounter} />
</form>

<style>
  fieldset {
    margin: 0 0 1rem;
    padding: 0.5rem 1rem;
    border: 1px solid var(--bg-2);
    border-radius: 4px;
  }

  legend {
    padding: 0 0.5ch;
    color: var(--heading-3);
    font-weight: bold;
  }

  .line {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.5ch 1ch;
    margin: 0.5rem 0;
  }

  .xp {
    margin-left: auto;
    color: var(--text-1);
  }

  .warning {
    flex-basis: 100%;
    font-size: 0.8em;
    color: var(--threat-severe);
  }

  button {
    font: inherit;
    cursor: pointer;
    color: var(--text-1);
    background: none;
    border: 1px solid var(--bg-2);
    border-radius: 4px;
    padding: 0 0.6ch;
  }

  button:hover,
  button:focus-visible {
    color: var(--primary-color);
    border-color: var(--primary-color);
  }

  .remove:hover,
  .remove:focus-visible {
    color: var(--threat-extreme);
    border-color: var(--threat-extreme);
  }
</style>
