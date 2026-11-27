<script lang="ts">
  import { cubicOut } from "svelte/easing";
  import { prefersReducedMotion, Tween } from "svelte/motion";
  import type { Budget, Encounter, Rating, Threat } from "./rules";

  let { encounter }: { encounter: Encounter } = $props();

  const NAMES: Record<Rating, string> = {
    trivial: "Trivial",
    low: "Low",
    moderate: "Moderate",
    severe: "Severe",
    extreme: "Extreme",
    "beyond-extreme": "Beyond extreme",
  };

  // The bar ends at the extreme budget; anything over bursts out of it.
  let segments = $derived(barSegments(encounter.budgets));
  let scale = $derived(segments.at(-1)!.end);
  let shown = $derived(segments.filter((segment) => segment.end > segment.start));
  let broken = $derived(encounter.xp > scale);
  // One animated total drives every segment, so the fill stays contiguous mid-animation.
  const fillXp = Tween.of(() => encounter.xp, {
    duration: () => (prefersReducedMotion.current ? 0 : 150),
    easing: cubicOut,
  });

  interface Segment {
    threat: Threat;
    start: number;
    end: number;
  }

  // A budget below the one before it (low, for parties under three) gets no width.
  function barSegments(budgets: Budget[]): Segment[] {
    let start = 0;
    return budgets.map(({ threat, xp }) => {
      const segment = { threat, start, end: Math.max(start, xp) };
      start = segment.end;
      return segment;
    });
  }

  function filled({ start, end }: Segment, xp: number): number {
    return Math.min(1, Math.max(0, (xp - start) / (end - start)));
  }

  const percent = (xp: number) => `${(100 * xp) / scale}%`;

  // The overflow stops at the screen edge rather than widening the page.
  let track: HTMLElement;
  let room = $state(0);
  function measureRoom() {
    room = document.documentElement.clientWidth - track.getBoundingClientRect().right;
  }
  $effect(measureRoom);
</script>

<svelte:window onresize={measureRoom} />

<div class="threat-bar">
  <p class="rating" style:color="var(--threat-{encounter.rating})">
    {NAMES[encounter.rating]}
    <span class="xp">{encounter.xp} XP</span>
  </p>
  <p class="award">Award {encounter.awardPerCharacter} XP to each character</p>

  <div class="names" aria-hidden="true">
    {#each shown as segment (segment.threat)}
      <span
        class:current={segment.threat === encounter.rating}
        style:width={percent(segment.end - segment.start)}
        style:color="var(--threat-{segment.threat})">{NAMES[segment.threat]}</span
      >
    {/each}
  </div>

  <div
    bind:this={track}
    class="track"
    class:broken
    role="meter"
    aria-label="Encounter XP"
    aria-valuemin={0}
    aria-valuemax={scale}
    aria-valuenow={Math.min(encounter.xp, scale)}
    aria-valuetext="{encounter.xp} XP, {NAMES[encounter.rating]}"
  >
    {#each shown as segment (segment.threat)}
      <div
        class="segment"
        style:width={percent(segment.end - segment.start)}
        style:--colour="var(--threat-{segment.threat})"
      >
        <span class="fill" style:width="{100 * filled(segment, fillXp.current)}%"></span>
      </div>
    {/each}
    <span
      class="overflow"
      style:width={percent(Math.max(0, fillXp.current - scale))}
      style:max-width="{room}px"
    ></span>
  </div>

  <div class="ticks" aria-hidden="true">
    {#each shown as segment (segment.threat)}
      <span class="tick" style:left={percent(segment.end)}>{segment.end}</span>
    {/each}
  </div>
</div>

<style>
  .threat-bar {
    margin: 1.5rem 0;
  }

  .rating {
    margin: 0;
    font-size: 1.4em;
    font-weight: bold;
  }

  .award {
    margin: 0 0 0.5rem;
    font-size: 0.8em;
    color: var(--text-1);
  }

  .xp {
    margin-left: 0.5ch;
    font-size: 0.7em;
    font-weight: normal;
    color: var(--text-1);
  }

  .track {
    position: relative;
    display: flex;
    height: 2.5rem;
    border: 1px solid var(--bg-2);
    border-radius: 4px;
  }

  .segment {
    position: relative;
    box-sizing: border-box;
    overflow: hidden;
    background-color: color-mix(in srgb, var(--colour) 15%, var(--bg-0));
  }

  .segment:first-child {
    border-radius: 3px 0 0 3px;
  }

  .segment:last-child {
    border-radius: 0 3px 3px 0;
  }

  .segment + .segment {
    border-left: 2px solid var(--bg-0);
  }

  .fill {
    position: absolute;
    inset: 0 auto 0 0;
    background-color: var(--colour);
  }

  /* Past extreme the fill tears through the end of the bar and keeps going. */
  .overflow {
    position: absolute;
    inset: -1px auto -1px 100%;
    background-color: var(--threat-beyond-extreme);
    clip-path: polygon(
      0 0, 100% 0, 100% 100%, 0 100%,
      6px 85%, 0 70%, 5px 55%, 0 40%, 7px 25%, 0 12%
    );
  }

  .broken {
    border-right-color: transparent;
    border-radius: 4px 0 0 4px;
    animation: shake 300ms ease-out;
  }

  .broken .segment:last-child {
    border-radius: 0;
  }

  @keyframes shake {
    20% { transform: translateX(-4px) rotate(-0.5deg); }
    40% { transform: translateX(4px) rotate(0.5deg); }
    60% { transform: translateX(-3px); }
    80% { transform: translateX(2px); }
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

  .tick:last-child {
    transform: translateX(-100%);
  }

  @media (prefers-reduced-motion: reduce) {
    .broken {
      animation: none;
    }
  }
</style>
