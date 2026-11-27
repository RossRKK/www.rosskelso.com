<script lang="ts">
  import type { Encounter, Rating } from "./rules";

  let { encounter }: { encounter: Encounter } = $props();

  // Room past the extreme budget so going over it shows on the bar.
  const OVERFLOW = 1.25;

  const NAMES: Record<Rating, string> = {
    trivial: "Trivial",
    low: "Low",
    moderate: "Moderate",
    severe: "Severe",
    extreme: "Extreme",
    "beyond-extreme": "Beyond extreme",
  };

  let segments = $derived(barSegments(encounter));
  let scale = $derived(segments.at(-1)!.end);

  interface Segment {
    rating: Rating;
    start: number;
    end: number;
  }

  function barSegments({ budgets }: Encounter): Segment[] {
    const ends = budgets.map((budget) => ({ rating: budget.threat as Rating, end: budget.xp }));
    const extreme = ends.at(-1)!.end;
    ends.push({ rating: "beyond-extreme", end: Math.round(extreme * OVERFLOW) });
    return ends.map(({ rating, end }, i) => ({ rating, start: ends[i - 1]?.end ?? 0, end }));
  }

  function filled({ start, end }: Segment, xp: number): number {
    return Math.min(1, Math.max(0, (xp - start) / (end - start)));
  }

  const percent = (xp: number) => `${(100 * xp) / scale}%`;
</script>

<div class="threat-bar">
  <p class="rating" style:color="var(--threat-{encounter.rating})">
    {NAMES[encounter.rating]}
    <span class="xp">{encounter.xp} XP</span>
  </p>

  <div class="names" aria-hidden="true">
    {#each segments as segment (segment.rating)}
      <span
        class:current={segment.rating === encounter.rating}
        style:width={percent(segment.end - segment.start)}
        style:color="var(--threat-{segment.rating})">{NAMES[segment.rating]}</span
      >
    {/each}
  </div>

  <div
    class="track"
    role="meter"
    aria-label="Encounter XP"
    aria-valuemin={0}
    aria-valuemax={scale}
    aria-valuenow={Math.min(encounter.xp, scale)}
    aria-valuetext="{encounter.xp} XP, {NAMES[encounter.rating]}"
  >
    {#each segments as segment (segment.rating)}
      <div
        class="segment"
        style:width={percent(segment.end - segment.start)}
        style:--colour="var(--threat-{segment.rating})"
      >
        <span class="fill" style:width="{100 * filled(segment, encounter.xp)}%"></span>
      </div>
    {/each}
  </div>

  <div class="ticks" aria-hidden="true">
    {#each segments.slice(0, -1) as segment (segment.rating)}
      <span class="tick" style:left={percent(segment.end)}>{segment.end}</span>
    {/each}
  </div>
</div>

<style>
  .threat-bar {
    margin: 1.5rem 0;
  }

  .rating {
    margin: 0 0 0.5rem;
    font-size: 1.4em;
    font-weight: bold;
  }

  .xp {
    margin-left: 0.5ch;
    font-size: 0.7em;
    font-weight: normal;
    color: var(--text-1);
  }

  .track {
    display: flex;
    height: 2.5rem;
    border: 1px solid var(--bg-2);
    border-radius: 4px;
    overflow: hidden;
  }

  .segment {
    position: relative;
    box-sizing: border-box;
    background-color: color-mix(in srgb, var(--colour) 15%, var(--bg-0));
  }

  .segment + .segment {
    border-left: 2px solid var(--bg-0);
  }

  .fill {
    position: absolute;
    inset: 0 auto 0 0;
    background-color: var(--colour);
    transition: width 150ms ease-out;
  }

  .names {
    display: flex;
    font-size: 0.7em;
  }

  .names span {
    overflow: hidden;
    padding: 0 0.4ch;
    white-space: nowrap;
    text-overflow: ellipsis;
    text-align: center;
  }

  .names .current {
    font-weight: bold;
  }

  .ticks {
    position: relative;
    height: 1.2em;
    font-size: 0.7em;
    color: var(--text-2);
  }

  .tick {
    position: absolute;
    transform: translateX(-50%);
  }

  @media (prefers-reduced-motion: reduce) {
    .fill {
      transition: none;
    }
  }
</style>
