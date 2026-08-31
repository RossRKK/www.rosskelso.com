# Post ideas

Scratch list of things worth writing. Lives at the repo root, not in
`content/`, so Zola never builds it.

The site has two working modes so far: the **evidence essay** (sand-dogs) and
the **fiddly thing done properly** writeup (sims3, starship-encounter). Most
ideas below are one or the other.

## Evidence essays

The transferable method from sand-dogs: take a claim circulating without
evidence, define what would have to be true for it to hold, then go looking.

- [ ] **Software folklore with a dead-end citation chain.** "ORMs are slow",
      "microservices scale better" — pick one and actually measure it. The k6
      and deadlock-diagnosis work at Cintra is the relevant experience.
- [ ] **The AI coding assistant discourse.** Both camps ("writes all my code" /
      "useless") run largely on hearsay. Having built an MCP server against a
      real full-stack codebase is first-hand data most commentators lack. Same
      shape as sand-dogs.
- [ ] **Low-stakes conspiracy theories as a category.** Gestured at in the
      sand-dogs conclusion and then dropped. Why the harmless ones are worth
      studying: same structure as the dangerous ones, none of the political
      incentive to muddy the analysis.

## Guides / writeups

Things done that are hard to find written down elsewhere.

- [ ] **k6 load testing → unrolling dynamic SQL in triggers → 5x throughput.**
      Probably the single most publishable thing on the CV. People search for
      "deadlocks caused by triggers" and almost nobody writes it up.
- [ ] **Validation middleware bug.** Premature type conversion making
      required-field and date validation silently pass. A genuine
      class-of-bug post — the kind that still gets linked years later.
- [ ] **Writing an MCP server for a real codebase.** Most MCP content is toy
      demos. Searching a full-stack codebase and modelling database
      relationships and constraints is the hard part, and it's underwritten.
- [ ] **More Steam Deck / Lutris archaeology.** The Sims 3 guide is likely the
      most-visited page on the site; more awkward DVD-era games would compound
      on traffic that already exists.

## Where the two modes meet

- [ ] **Computer vision in cue sports.** The dissertation PDF is on
      `/downloads` and nobody will click it. What actually worked and what
      didn't would get read.
- [ ] **Synthetic GPS traces for privacy protection.** Same — and topical again
      given current location-privacy debates.
- [ ] **GMTK 2025 jam postmortem.** The ZIP is on `/downloads` with no writeup
      at all. Well-established form, and currently an untold story.

If picking two: the **trigger/deadlock writeup** (highest search value,
entirely yours) and the **AI assistant evidence piece** (plays to the
sand-dogs voice, which is the reason anyone would subscribe).

## Site housekeeping

- [ ] `content/typography.md` is the Grav/Quark theme demo page — `draft = true`,
      lorem ipsum, references a theme this site doesn't use. Delete unless it's
      being kept as a style reference.
