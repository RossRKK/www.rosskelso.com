+++
title = "Starfinder 2e - Find the Gimmick"
date = "2026-09-06"
draft = true

[taxonomies]
tags = ["starfinder", "ttrpg"]
+++

In [Scum and Villainy](@/blog/scum-and-villainy.md) I said that one of the ways
I wanted to streamline starfinder combat was to pre-prepare finite state
machines for enemy behaviour, so that monster moves are more mechanical. This
post is my attempt to work out what that actually means, because every time
I've tried it so far the result has been something I didn't use at the table.

I started out thinking of this as a prep trick to make my turns faster, and it
is one — I don't want to undersell that. A turn where I already know what four
creatures are doing is a fraction of the length of one where I'm working it
out in front of everybody, and that time comes straight back to the players.
But it turns out that's only half of what it buys, and the whole thing reduces
to one line:

**The best fights have a gimmick. So do Paizo's monsters. Find it.**

Everything below is really just the long version of that. Find the gimmick,
build the state machine around it, telegraph it, and use it in the first round
so the players have something to plan against.

## The problem

When combat drags at my table it is very often my fault, not the system's. On
a player's turn there is one character sheet, one player, and a set of options
they have been thinking about since the last time initiative came round. On my
turn there are four enemies, and for each one I am re-reading a statblock,
picking between six abilities I half remember, and doing the arithmetic of
three actions in public. The players are waiting the whole time.

The fix isn't fewer options in the game, it's fewer decisions in the moment. I
want to have already made the decisions before the session, and to spend my
turn narrating rather than choosing.

## What a monster state machine is

For each enemy, before the session, I write down a small number of states.
Each state says what a full turn looks like — all three actions — and what
makes the creature leave that state. At the table I read the current state,
narrate it, roll, and check whether a transition fired. No choosing.

The important thing is that this is not a decision tree for playing the monster
optimally. It's a description of how this creature behaves, committed to in
advance, so that behaviour is consistent and fast rather than clever.

## Why my first attempts didn't work

I have tried getting these generated for me and the results were unusable at
the table. Looking at what went wrong, the failures were all the same few
things:

- **Too many states.** A machine with seven states is a statblock with extra
  steps. If I have to read a page to find out what the creature does, I have
  saved nothing.
- **Transitions on things I wasn't tracking.** "When it has taken damage from
  three different sources", "on its third turn in melee". If a transition
  needs its own bookkeeping then I am now running the encounter *and*
  maintaining a small database.
- **States that were lists of options rather than a turn.** "It may Strike, or
  it may Step and Strike, or it may use its reaction." That's the statblock
  again. The whole value is in having already picked.
- **Optimal play instead of characterful play.** A machine that always makes
  the correct tactical choice produces four enemies that behave identically
  and read as a single organism. Enemies being wrong in a way that suits them
  is most of what makes them feel like people.

## Prior art

I should say up front that none of this is new. Keith Ammann has been doing
the hard version of it for years, first on
[The Monsters Know What They're Doing](https://www.themonstersknow.com/) and
then in the books of the same name. His write-ups end up in more or less the
shape I'm describing: an opening move, what the creature does once it's
engaged, and the condition on which it gives up and runs.

The part I want to steal is the bit my attempts were missing entirely. I had
been thinking about what a state machine should look like, and not at all
about where the states come from. His answer is that you read them off the
statblock rather than inventing them:

- **Strength against Dexterity** tells you whether the creature closes and
  grapples or skirmishes at range.
- **Intelligence caps how clever the tactics are allowed to be.** A stupid
  creature is not permitted to focus fire the healer, even though that is the
  correct play. This is the one that fixes my "optimal instead of
  characterful" problem, and it fixes it with a rule rather than with taste.
- **Wisdom governs self preservation**, which gives you a morale threshold —
  roughly, when does this thing decide the loot isn't worth dying for — and
  therefore gives you your last transition for free.

Two caveats. It's written for 5e, and the specific problem I have is a
starfinder problem: 5e doesn't have three actions a turn to plan, and the
thing that eats my time is having four creatures rather than any one of them
being complicated. And his write-ups are prose analysis, several paragraphs
per monster, which is the opposite of what I need at the table. The
compression is the part I have to do myself.

## The rubric

So here is what I think the constraints actually are.

- **Two to four states.** Most creatures in a starfinder encounter live one or
  two rounds. If you have written a fourth state you have almost certainly
  written something that will never be seen.
- **Every transition keys off something already visible at the table.** Its HP
  crossing half, being flanked, an ally going down, losing line of sight to
  the players, the round number. Nothing that needs a tally.
- **Each state is a whole turn, written imperatively.** "Stride to the nearest
  cover, then Strike the closest player twice." Not a menu.
- **The interesting ability appears in the first state.** More on this below.
- **One line of motivation at the top.** Why this creature is in the fight and
  what would make it stop. This is what lets you go off-machine sensibly.
- **Derive the states from the statblock, don't invent them.** Per the above:
  Str/Dex for how it wants to fight, Int for how clever it's allowed to be,
  Wis for when it breaks. If I can't point at the line on the statblock that
  produced a state, I've made it up, and made-up states are the ones I don't
  trust at the table.
- **At least one state should have a lever on it.** Something the players
  could interfere with from outside the fight, if they knew about it. See
  below — this is the bullet that turns a state machine into a plan.
- **It fits on the same card as the statblock.** If it lives in a different
  document I will not read it.

The motivation line matters more than it looks. The state machine is a default,
not a cage — when a player does something that the machine has no opinion
about, the motivation tells me what the creature does instead. Ignoring the
machine is always allowed; it is there to stop me deliberating, not to stop me
thinking.

## Telegraph everything, immediately

The other piece of advice I've picked up, and which I think is really the same
idea from the other end: telegraph abilities early and don't hide them.

The instinct from years of running games is to hold the good stuff back. Save
the big ability for when it will land hardest, keep the resistance secret so
discovering it is a moment. That instinct is wrong in a system where a mook
dies in one or two rounds. An ability you are saving for round three is an
ability you designed, wrote down, and will never get to use. The players will
never know it existed.

So: use it in round one, and say what is about to happen before it happens.
Announce that the enemy is bracing its cannon and it will fire next turn.
Announce that the plating is shrugging off small arms fire, rather than
quietly applying a resistance. This costs you a surprise and buys you the
thing you actually wanted, which is players making decisions about a threat
they can see. It also makes the state machine legible to the table: if the
creature visibly enters its "wounded and desperate" state, everyone gets to
respond to that.

This has a nice side effect for the state machine itself, which is that state
one should contain the signature move. If the creature only ever gets one
turn, that turn should be the one that shows the players what it is.

## Recall Knowledge finally has something to say

Recall Knowledge is an action I have never been good at adjudicating. It costs
a player one of their three actions, and the honest default answer — this one
has the highest resistance to fire, that one has a weak Will save — is a
number that usually doesn't change what anybody was going to do anyway. So
nobody spends the action, and a whole skill system sits unused during combat.

If I've already written the state machine down, I have a much better answer.
The machine *is* the secret, so I can hand it out a piece at a time:

- **Critical success:** the state it's in now, and the condition that takes it
  out of that state. "It's hunting the one furthest from the group, and it'll
  break off if two of you get next to it."
- **Success:** one state, or the motivation line. "It isn't trying to kill
  you, it's trying to get a body."
- **Failure:** nothing.
- **Critical failure:** a plausible transition that is wrong. "It'll panic if
  you set it on fire" — it has fire resistance 5, so that goes badly.

This is much better than misreporting a number, because being wrong about
behaviour is recoverable and interesting, whereas being wrong about a
resistance just wastes a turn.

What I like most is that it makes the skill do the thing the fiction says it
does. A character who has studied akatas doesn't know the creature's Fortitude
modifier — they know it hunts stragglers and won't fight a crowd. That is the
machine, and it's exactly what the player needed to know to make a decision.

It also gives the players a deliberate way to learn a machine instead of
discovering it by attrition. Telegraphing is the free information, broadcast
to everyone; Recall Knowledge is the paid information, and now it's worth
paying for.

## Worked examples

All three of these are real statblocks from the Archives of Nethys, picked
because their Intelligence scores are miles apart. That's the whole
demonstration: the same rubric produces three very different machines, and
almost all of the difference comes off the statblock rather than out of my
head.

### Akata (Creature 1)

[Akata](https://2e.aonsrd.com/creatures/56-akata) — Str +4, Dex +2, **Int
−4**, Wis +3. Jaws +9 (agile) for 1d6+4 plus void death. Speed 30, climb 15.
Scent 30 feet, darkvision, and no hearing at all. AC 16, HP 15.

*Wants a living host, not a meal. Breaks off if it can't get one.*

- **Stalk.** Climb or keep to cover and close on whichever character is most
  isolated. It cannot hear, so shouting, gunfire and warnings do not move it
  off that target — it goes by scent.
  - → *Latch* on reaching a lone target, or when spotted.
- **Latch.** Stride if needed, then jaws twice against that same target. It
  keeps biting the same creature until that creature is down. Int −4 means it
  is not allowed to switch to a better target, ever, however obviously correct
  that would be.
  - → *Slink* at 7 HP or below, or when two enemies are adjacent.
- **Slink.** Climb away at full speed, ceiling or wall, out of reach. Returns
  to *Stalk* if it breaks line of sight. Wis +3 is doing the work here — it's
  stupid, but it isn't suicidal.

The deafness is the thing to telegraph. Say out loud, early, that it doesn't
react to noise; it turns a stat line into a tactic the players can use.

### Electrovore (Creature 2)

[Electrovore](https://2e.aonsrd.com/creatures/229-electrovore) — Str +2, **Dex
+4**, **Int −3**, Wis +1. Tail +8 for 2d4+2, zap +10 at 30 feet for 1d12+1.
Fly 20, electricsense 60 feet, immune to electricity. Electrical Discharge is
two actions, 2d6 in a 10-foot emanation, then unavailable for 1d4 rounds.

*Eats electricity. Is here for the power supply, not for the players.*

Dex over Str, and a ranged attack bonus higher than its melee one, says
skirmisher before I've decided anything. So it skirmishes.

- **Feed.** Fly to the loudest power source it can sense and start draining
  it. Zap anyone who closes. If two or more enemies are within 10 feet,
  Electrical Discharge immediately — round one, not held back.
  - → *Skirmish* when driven off the power source.
- **Skirmish.** Fly to hover at about 30 feet, out of melee, and zap the
  target carrying the most tech. Discharge again the moment it's available and
  two enemies are clustered. Int −3: it shoots whatever hums loudest, not
  whoever is healing.
  - → *Feed* if a new power source is exposed. → *Scatter* at 15 HP or below.
- **Scatter.** Fly away toward the nearest conduit in a straight line, without
  using cover, because it isn't clever enough to.

Its motivation lets it leave a fight it's winning, which is the sort of thing
I would never remember to do in the moment but will happily read off a card.

### Aeon Guard Commander (Creature 7)

[Aeon Guard Commander](https://2e.aonsrd.com/creatures/54) — Str +4, Dex +2,
**Int +0**, Wis +3, Cha +3, with Warfare Lore and three social skills at +16.
Dueling sword +18 for 2d8+7, boom pistol +16 at 40 feet. Rally the Troops,
Tactical Strike once per round, and Terrifying Takedown as a free action when
he drops someone. AC 24, HP 115, Speed 25.

*Holding a position, and intends to bring his squad back. Discipline over
glory.*

Int +0 is the licence. This one is allowed to do everything the other two
aren't: focus fire, target the healer, fall back to a chokepoint, exploit a
mistake.

- **Command.** Tactical Strike, naming the most dangerous-looking player, then
  Strike again, then Stride or pistol depending on range. The squad-wide buff
  goes out in round one, every time.
  - → *Rally* when two allies are down or the squad is split up.
- **Rally.** Rally the Troops, then Tactical Strike. He spends a whole turn
  not attacking to pull the squad back together, which is what a commander is
  for.
  - → *Command* once the line is re-formed.
- **Last Stand.** At 57 HP or below with his squad broken: back to a doorway
  or corridor mouth, dueling sword twice, letting Reactive Strike and
  Terrifying Takedown do the rest. He does not run; Azlanti officers don't.

Three states each, every transition something already on the table — HP past
half, allies down, adjacency, line of sight — and in all three cases the
signature ability fires in the first round.

## Predictability is the point

When I started writing this I had "the enemies become predictable" down as the
main risk. I now think that's backwards, and that predictability is most of
what I'm actually buying.

Players can only make tactical decisions about a system they can model. If a
creature's behaviour is invented fresh by me every round then there's nothing
to learn, no read to make, and the correct play is unknowable — so combat
becomes rolling dice at each other until someone runs out. A machine I've
committed to in advance is learnable. Once someone works out that the akata
chases whoever is isolated, positioning becomes a real decision, and the
player who spotted it gets to feel clever. That feeling is the thing I said I
wanted at the end of the last post: a tight tactical game rather than a slog.

It's also why my two favourite comparisons work. The enemies in Baldur's Gate
3 are literally state machines and nobody minds; learning what they do is the
fun. Undaunted is almost entirely deterministic and it's tense anyway, because
you can see the machine perfectly well and still have to beat it.

### Which starts before initiative

The bit I care about most, though, happens before the fight. Half the fun of
knowing what a monster does is getting to do something about it in advance.
"We're going after werewolves, so I'm buying silver bullets" is a great
moment, and none of what makes it great happens at the table during combat —
it happens in a shop, an hour earlier, because the players knew what they were
walking into.

The best example I have of this is one I didn't plan at all. My players landed
on a desert planet and immediately decided I was doing Dune and that there
would be a sandworm. I wasn't, but I am not so proud as to turn down a gift,
so there was a sandworm. Mechanically it was a reskinned
[cave worm](https://2e.aonprd.com/Monsters.aspx?ID=2871) with the weak
adjustment, so a level 12 pathfinder monster with Str +9, **Int −5**,
tremorsense 100 feet, and a chain of abilities — Improved Grab on its jaws,
Fast Swallow as a reaction, then Swallow Whole — that is already a state
machine written by somebody else. I didn't have to design the behaviour. Paizo
had done it, and the fiction the players had brought with them from Dune
agreed with it.

The one thing I did add was an ability I called Swirling Sand: a 25 foot cone
of disturbed sand trailing behind the worm based on its last movement, DC 30
Reflex to avoid, failing which you start sinking. That's the only part of the
reskin that isn't cosmetic, and looking back it's doing the same job as a
state — it makes where the worm has just been into something the players have
to think about, rather than just a number of feet it moved.

What's interesting is what they did with a prediction I hadn't confirmed.
Fighting a huge single-target enemy, they assumed it would try to swallow them
whole — which was correct, because that is what sandworms do. My solarian
banked on it, deliberately got swallowed, and set off a supernova inside the
worm. Swallow Whole has a Rupture value — 24, in this case — which is the
damage you need to do in one go to cut your way back out. A supernova clears
that comfortably. The plan wasn't a stunt, it was reading a number off the
back of a mechanic he had correctly predicted would come up.

That only works if the creature's behaviour is predictable. Nobody volunteers
to be eaten on a maybe. The player wasn't gambling on a die roll, he was
gambling on the worm having a state he could name in advance, and the payoff
for reading the machine correctly was the best moment of the session.

The lever was there too, and I didn't even notice it at the time. Tremorsense
100 feet, imprecise, on a creature with Int −5: it cannot see, it cannot think,
and it goes to whatever is thumping. That is the Dune thumper, sitting in the
statblock, waiting for anyone who thought to ask what the worm actually hunts
by. Nobody did on the night, but if they'd known it in advance, half the
encounter is solvable by throwing something noisy in the wrong direction.

Worth noting that all of this survived the reskin. The numbers came from a
pathfinder monster in a cave, and none of that mattered, because the machine —
grab, swallow, follow the vibrations, too stupid to do anything else — travels
with the fiction rather than with the statblock. Which is a good argument for
writing the machine down separately from the numbers in the first place.

Then there's the other half of it, which happened before the fight at all.
They had decided they wanted to capture the worm, and they knew it would be
huge, so they went shopping: a
[shrinking potion](https://2e.aonprd.com/Equipment.aspx?ID=2958) and a
[null-space chamber](https://2e.aonsrd.com/treasure/113), which they
immediately christened "the pokeball". The chamber even cooperates on this —
it can only be opened from the outside, and it fills with breathable air —
so it is, as written, a functioning worm container. That is the silver
bullets thing exactly. It was bought in a shop, in advance, on the strength of
a predicted state machine, and it was entirely their idea.

It worked, too. The actor is still sitting in my foundry world: 71 hit points
left out of 270, size reduced to tiny, and set to the party's alliance rather
than mine. Which I think is the most complete possible answer to the question
of whether letting players predict a monster is bad for the game. They read
the machine, made a plan in a shop, and now the sandworm is theirs.

The lesson I took from it is that when the players guess the machine, the
correct move is to let them be right. Every instinct I have as a GM says to
subvert the obvious — actually it's not a sandworm, actually it doesn't
swallow. But subverting a correct prediction punishes the exact behaviour I
want to encourage, and teaches the table that planning is a waste of time. If
they've done the work of predicting, the reward is that the prediction pays.

The state machine is exactly the thing that makes that possible in
starfinder. If the party knows they're going to run into electrovores, then
"it feeds on power and it will leave a fight it's winning to go and eat a
generator" isn't trivia, it's a plan. Drop a charged battery down the far
corridor and the encounter is half won before anyone rolls initiative. That is
a much better use of an evening than optimising a third Strike.

For that to work the machine has to be knowable in advance, which means I have
to be willing to give it away: through reputation, through a Recall Knowledge
check made in the safety of the ship, through having fought one of these
before, through an NPC who complains about them. A secret machine only pays
out during the fight. A published one pays out during the planning, during the
fight, and again afterwards when they realise the trick will work on the next
one too.

It also puts a requirement back on the machine, which is that at least one
state needs a lever the players can reach from outside the fight — a
motivation to bait, a sense to fool, a trigger to pull early. The electrovore's
hunger is a lever. The akata's deafness is a lever. A creature whose only
state is "attacks the nearest player" has nothing to plan against, which is
another way of saying it isn't a very interesting creature.

This is the part I got wrong in the last post, incidentally. I said that what
my table enjoys is coming up with a ludicrous quarter-baked plan and then
watching it go wrong, and I treated that as something the roleplaying happens
around rather than something the combat rules could support. Monster state
machines are combat prep that feeds the planning. It's the same fun, arriving
through the mechanics instead of in spite of them.

The real risk isn't predictability, it's sameness. Four creatures running the
same machine is boring — that's the "single organism" problem from further up.
Four creatures running four legibly different machines is a puzzle. So I want
each creature to be predictable and none of them to be alike, which is another
argument for deriving the states from the statblock rather than from my mood
on the night.

## The gimmick is the machine

The other thing I've learned from that fight is that it is always worth having
a gimmick. This is the oldest lesson I have about running games: the very first
session I ever ran had a trap where lava slowly rose out of the floor, lifted
straight out of some book of dungeon traps whose title I've long since
forgotten, and it worked. Rolling ball. Rising lava. People remember these.

The best one I ever built was a room of holographic goblins that respawned
out of your field of view every time you killed one. The only way to win was
to work out that the goblins weren't the problem and shoot the projectors.

That encounter is a state machine, and I didn't think of it that way at the
time. Killing a goblin doesn't remove it, it transitions it into "will come
back where you aren't looking". The projectors are the lever. And crucially
the players cannot beat it until they've reverse engineered the rule, which
means the entire encounter is about reading the machine rather than about
grinding the hit points off it. Nobody at that table was bored, and it wasn't
because the numbers were interesting.

So here's where I've ended up: a gimmick is a state machine the players have
to work out, and a state machine is a gimmick I've bothered to write down. The
reason I want these on cards isn't only that my turns get faster. It's that
writing one forces me to answer "what is the thing about this creature that
the players could notice and exploit?" — and if the answer is nothing, I've
picked a boring monster.

The good news is that I mostly don't have to invent them. Plenty of pre-made
monsters already come with a gimmick; the skill is spotting which line of the
statblock it is. The akata's deafness is a gimmick. The electrovore leaving a
fight to go and eat a generator is a gimmick. Tremorsense 100 feet on a
creature too stupid to do anything but follow it is a gimmick, and it's the
one I had in front of me for a whole session without noticing. Identifying it
is most of the work, and it's the part I'd been skipping.

It's true at the family level too, which is where it's easiest to see. Goblins
scuttle. Zombies are slow. Oozes split when you cut them. Swarms don't care
about your gun. Every creature family in pathfinder and starfinder has a thing
it does that nothing else does, and that thing is almost always the most
interesting fact about fighting it. If the encounter doesn't revolve around it
then I've built a fight that happens to contain goblins rather than a goblin
fight.

The gimmick pays the time back as well, which I hadn't expected. A fight built
around one clear thing needs far less adjudication than a fight built around
six vaguely interesting ones, because almost every question that comes up at
the table refers back to the same mechanic — is the goblin in cover, can it
scuttle from there — instead of sending me back into the statblock for
something new each time. Narrowing the encounter to one idea makes it quicker
to run and better to play at the same time, which is not a trade I get offered
very often.

Which gives me the whole method in one chain: find the gimmick, make it the
core of the state machine, telegraph it, and spend it in round one — because
the point of all of it is that the players get to plan around the thing, and
they can't plan around what they haven't been shown.

And sometimes the players build one out of your monster and hand it back. They
kept the shrunken worm, and deployed it later at an opportune moment, which I
did not plan for and could not have written down in advance.

## Next steps

I haven't run enough combats with this to know whether it survives contact.
The thing I'm least sure about is whether writing these takes longer than the
time they save — three states a creature is not free, and a session with six
distinct enemies is an evening's prep.

I'll write a follow up once I've run a few sessions with them, with the cards
I actually used, what my turns looked like, and whether anyone spent an action
on Recall Knowledge.
