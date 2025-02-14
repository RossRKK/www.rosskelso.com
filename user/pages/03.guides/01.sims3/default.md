---
title: Sims 3 on Deck
published: true
partials:
    header_subtitle:
        toggle: true
    metadata:
        where: header
    breadcrumbs:
        toggle: true
---

How to install the Sims 3 and it's expansions on a steam deck from the DVDs using Lutris.

===

# Installing the Sims 3 on a Steam Deck from a DVD

! An expansion pack as new or newer than 'Showtime' is required to follow these instructions

## Step 0 - Dumping the Disks

On another computer with a DVD drive use a program like [ImgBurn](https://www.imgburn.com/) to dump your physical DVD(s) and make a note of the product keys for the base game and any expansions.

[Note] You can probably do this on the steam deck itself (if you have an external disk drive), it's just not how I did it.

Copy these ISO files to the steam deck however you like (I used my networked attached storage).

## Step 1 - Pre-requisites

Switch your steam deck into desktop mode. I recommend plugging in a mouse keyboard and external monitor as it will make this (and playing the game) much easier.

Install "Lutris" and "Mount Unmount ISO" using the discover store.

We'll use Lutris to run the Windows version of the game on linux. "Mount Unmount ISO" provides an easy way to mount the DVD ISOs so that we can run the installer.

## Step 2 - Mount the ISO

Right click the ISO for the base game and select "Mount".

## Step 3 - Installing with Lutris

Create a new game by selecting the '+' in the top left and then selecting "Install a Windows game from an executable".

Call the game "The Sims 3" or something else reasonable. Make sure the game's identifier is "the-sims-3" so that lutris automatically pics up the box art.

Click "Install" and then `[wine] Setup file`.

Select an installation directory. By default this is in your home directory however this can be wherever you like. I changed it to a new folder on my SD card since I'm out of space on the internal storage.

Set the 'Setup File' by selecting the path to `Sims3Setup.exe` inside the mounted copy of the base game ISO.

Click 'Install'. This will run the Sims 3 installer. Some of the windows will appear minimised or in odd places but it should work. Select type in your product key and select 'Typical' installation.

Make sure 'Install the EA Download Manager' is selected since we will use this to update the game.

## Step 4 - Install Origin

You cannot update the game to the latest version without installing Origin.

This can be done by following the instructions to install an expansion pack as new or newer than 'Showtime'.

TODO: Instructions for installing Origin manually. This may be tricky since it was replaced with the EA app.

## Step 5 - Updating the Game

Before this will work you must install an expansion pack as new or newer than "Showtime" in order to update the game to a point where the updater will work. (Some earlier packs may work for this, but I haven't tested them).

Right click the game in Lutris and then 'Configure', go to 'Game options' and then set the 'Executable' path to `<the path you chose>/drive_c/Program Files (x86)/Electronic Arts/The Sims 3/Game/Bin/Sims3Launcher.exe`

Launch the game and use the launcher to update the game to the newest version.

A sort of blank window will open with the title "Downloading Updates..."


## Step 6 - Installing the No CD Mod

The game and launcher both have checks to ensure the disk is inserted into the PC that is running the game.

Bypass the launcher's check by bypassing the launcher. Configure Lutris to launch TS3.exe directly. Right click the game in Lutris and then 'Configure', go to 'Game options' and then set the 'Executable' path to `<the path you chose in step 3>/drive_c/Program Files (x86)/Electronic Arts/The Sims 3/Game/Bin/TS3.exe`

Run the game again to create the folder structure in the Documents folder. You should get an error telling you to insert the disk, quit the game.

Download the mod framework from [mod the sims](https://modthesims.info/wiki.php?title=Game_Help:Installing_Sims_3_Package_Files/Setup_and_Files). We install them in a similar way but our Sims 3 folder is here: `<the path you chose in step 3>/drive_c/users/deck/Documents/Electronic Arts/The Sims 3/`.

Download [NRaas NO CD mod](https://www.nraas.net/community/NoCD) and put it in the `Packages` folder.

## Installing Expansion Packs

Right click the game in Lutris and select 'Configure'. Go to the 'Game options' tab and change the executable to the Setup exe in the mounted copy of the expansions disk ISO. Now running the game will actually run the installer.

Run the installer, agree to any updates and enter you product key.

Change the games executable in Lutris back to `<the path you chose in step 3>/drive_c/Program Files (x86)/Electronic Arts/The Sims 3/Game/Bin/TS3.exe`.

If you are asked to install the latest version of Origin agree. This seems to be what gets the game updater working.





