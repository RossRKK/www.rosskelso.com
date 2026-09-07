# Recipe Grid (https://mossblaser.github.io/recipe_grid/), the compiler that
# turns the recipe description language in recipes/ into the merge tables the
# recipe posts are made of. Neither it nor its parser library are in nixpkgs,
# so both are built here from their PyPI sdists — pure Python, so this builds
# the same on styx (linux) as it does locally.
#
# Used as `nix shell --file recipe-grid.nix` by dev.sh and by the
# website-update unit in chaos.nix; bump `version` + `hash` together.
{ nixpkgs ? <nixpkgs>, pkgs ? import nixpkgs { } }:

let
  python = pkgs.python3;

  peggie = python.pkgs.buildPythonPackage rec {
    pname = "peggie";
    version = "0.2.1";
    format = "setuptools";
    src = python.pkgs.fetchPypi {
      inherit pname version;
      hash = "sha256-XrUCWxG0JIuMqJPRrF05D5KrpBkX0jMWi5B43PuQyKA=";
    };
    doCheck = false;
  };

  recipe-grid = python.pkgs.buildPythonPackage rec {
    pname = "recipe_grid";
    version = "2.1.1";
    pyproject = true;
    build-system = with python.pkgs; [ setuptools ];
    src = python.pkgs.fetchPypi {
      inherit pname version;
      hash = "sha256-9uotarE02qMmuVXumVBkGLonOOcZrEHWleemcBKPqEE=";
    };
    propagatedBuildInputs = with python.pkgs; [ lxml marko jinja2 peggie ];
    # Upstream pins marko~=2.0.0; nixpkgs carries 2.2.x, which works fine here
    # (only the block/inline parser API this uses, unchanged across 2.x).
    dontCheckRuntimeDeps = true;
    doCheck = false;
  };
in
python.withPackages (_: [ recipe-grid ])
