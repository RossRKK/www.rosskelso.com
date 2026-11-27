# The site's JS tools (tools/), built into one script per tool. The output is
# what goes in static/tools/; dev.sh and the website-update unit in chaos.nix
# copy it there before running zola. Bump `npmDepsHash` with the lockfile:
#   nix run nixpkgs#prefetch-npm-deps -- tools/package-lock.json
{ nixpkgs ? <nixpkgs>, pkgs ? import nixpkgs { } }:

pkgs.buildNpmPackage {
  pname = "rosskelso-tools";
  version = "0";
  # A local npm install would otherwise be copied into the store with the source.
  src = pkgs.lib.cleanSourceWith {
    src = ./tools;
    filter = path: _type: baseNameOf path != "node_modules";
  };
  npmDepsHash = "sha256-K4eSfyOJmd/IWlk/lO+PkO/czqIqIIWys26CmLT7sKo=";

  doCheck = true;
  checkPhase = ''
    runHook preCheck
    npm run check
    npm test
    runHook postCheck
  '';

  buildPhase = ''
    runHook preBuild
    npx vite build --outDir "$out"
    runHook postBuild
  '';
  dontNpmInstall = true;
  installPhase = "true";
}
