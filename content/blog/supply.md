+++
title = "Supply - A Card Game"
date = "2026-11-08"
draft = true

[taxonomies]
tags = ["games", "card-games"]
+++

Supply is a two-player deck-building game for a standard deck of playing cards,
designed by me and Gavin Lamb. Each suit has a job: hearts defend, diamonds
attack, and spades and clubs are money. You start with a tiny hand of cash,
buy better cards from a shared row, and try to grind your opponent's health
down to zero before they do the same to you.

There's a [printable two-page version of the rules](/files/games/supply-rules.pdf)
if you'd rather have it on the table.

## What you need

- One standard 52-card deck, plus jokers if you want them
- Something to track each player's health — a pen and paper is fine

## Setup

- Each player's starting hand is the 2, 3 and 4 of money (♠/♣) — one player
  takes the spades, the other the clubs.
- Each player has a deck, a hand and a discard pile. Initially the decks and
  discard piles are empty.
- Set aside the Aces of money (♠/♣).
- Each player starts with 30 health.
- Shuffle the rest of the cards to form the supply deck, and deal the first 5
  from the top to form the supply row.

The table should look something like this:

```
Player 1's hand:       2♠  3♠  4♠              Set aside: A♠

Supply deck    [ 5♦  10♥  10♣  Q♦  7♠ ]      Scrap pile
   [▒▒]             supply row                  [  ]

Player 2's hand:       2♣  3♣  4♣              Set aside: A♣
```

## Aim of the game

Reduce your opponent's health to zero.

## Playing a turn

1. Play 3 cards from your hand.
2. Resolve the resulting actions.
3. Draw back up to 5 cards.

If no cards remain in your deck, shuffle your discard pile to form a new deck.

If the supply row has 3 or more money cards, or 3 or more special cards, you
may scrap it and deal a fresh one — but only once per turn.

## Standard card abilities

### Defence (♥)

Playing defence cards creates a defensive barrier that stays in play. The
strength of the barrier is the total value of the defence cards played.

### Attack (♦)

Playing attack cards adds to a pool of attack points worth the sum of the
cards' values.

- If your opponent has a barrier in play, they cannot be attacked directly.
- A barrier is destroyed by removing attack points equal to its strength from
  the pool.
- If your opponent has no barriers in play, whatever is left in the pool is
  subtracted from their health.

### Money (♠/♣)

Playing money cards adds to a pool of money points worth the sum of the cards'
values.

- Any card in the supply row can be bought by spending money points from the
  pool equal to that card's cost. The card goes into your discard pile, and the
  gap in the supply row is refilled from the supply deck.
- Face cards, aces and jokers cost 15.
- Every other card costs its face value.

## Special card abilities

Face cards and aces have an ability on top of their suit. When they count
towards their suit's pool (defence, attack or money) they're worth their *suit
ability value*.

| Card  | Suit ability value | Ability                                                        |
|-------|-------------------:|----------------------------------------------------------------|
| Ace   | 1                  | Optionally scrap a card from your hand (it goes to the scrap pile) |
| Jack  | 1                  | Your opponent must discard one card and play one fewer card on their next turn |
| Queen | 10                 | Draw another card, then play an extra card                     |
| King  | 10                 | Gain 5 health                                                  |
