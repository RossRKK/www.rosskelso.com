<script lang="ts">
  // Emits only whole numbers in range; anything else snaps back on blur.
  let { value, min, max, label, onchange }: {
    value: number;
    min: number;
    max: number;
    label: string;
    onchange: (value: number) => void;
  } = $props();

  function parse(input: HTMLInputElement) {
    const parsed = input.valueAsNumber;
    if (Number.isInteger(parsed) && parsed >= min && parsed <= max) onchange(parsed);
  }
</script>

<input
  type="number"
  inputmode="numeric"
  {min}
  {max}
  {value}
  aria-label={label}
  oninput={(event) => parse(event.currentTarget)}
  onblur={(event) => (event.currentTarget.value = String(value))}
/>

<style>
  input {
    width: 4ch;
    font: inherit;
    color: var(--text-0);
    background-color: var(--bg-1);
    border: 1px solid var(--bg-2);
    border-radius: 4px;
    padding: 0.1rem 0.3rem;
    text-align: right;
    -moz-appearance: textfield;
    appearance: textfield;
  }

  input::-webkit-inner-spin-button,
  input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  input:focus {
    outline: 1px solid var(--primary-color);
    border-color: var(--primary-color);
  }
</style>
