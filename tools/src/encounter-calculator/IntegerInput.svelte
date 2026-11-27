<script lang="ts">
  // Emits only whole numbers in range; anything else snaps back on blur.
  let { value, min, max, label, onchange }: {
    value: number;
    min: number;
    max: number;
    label: string;
    onchange: (value: number) => void;
  } = $props();

  function parse(text: string) {
    if (!/^-?\d+$/.test(text.trim())) return;
    const parsed = Number(text);
    if (parsed >= min && parsed <= max) onchange(parsed);
  }
</script>

<span class="integer-input">
  <button type="button" tabindex="-1" aria-label="Decrease {label}" disabled={value <= min} onclick={() => onchange(value - 1)}>−</button>
  <!-- Text, not number, so a tap can select it and the steppers can reach negatives. -->
  <input
    type="text"
    inputmode="numeric"
    autocomplete="off"
    {value}
    aria-label={label}
    oninput={(event) => parse(event.currentTarget.value)}
    onfocus={(event) => event.currentTarget.select()}
    onmouseup={(event) => event.preventDefault()}
    onblur={(event) => (event.currentTarget.value = String(value))}
  />
  <button type="button" tabindex="-1" aria-label="Increase {label}" disabled={value >= max} onclick={() => onchange(value + 1)}>+</button>
</span>

<style>
  .integer-input {
    display: inline-flex;
    align-items: stretch;
    background-color: var(--bg-1);
    border: 1px solid var(--bg-2);
    border-radius: 4px;
  }

  .integer-input:focus-within {
    border-color: var(--primary-color);
  }

  input {
    width: 3ch;
    /* Under 16px, iOS zooms the page in on focus. */
    font: inherit;
    font-size: max(16px, 1em);
    color: var(--text-0);
    background: none;
    border: none;
    padding: 0.1rem 0;
    text-align: center;
  }

  input:focus {
    outline: none;
  }

  button {
    font: inherit;
    cursor: pointer;
    color: var(--text-1);
    background: none;
    border: none;
    padding: 0 0.5ch;
    touch-action: manipulation;
  }

  button:hover:not(:disabled) {
    color: var(--primary-color);
  }

  button:disabled {
    cursor: default;
    color: var(--bg-2);
  }
</style>
