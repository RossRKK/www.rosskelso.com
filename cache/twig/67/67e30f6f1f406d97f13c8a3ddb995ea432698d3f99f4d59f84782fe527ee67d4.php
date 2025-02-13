<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* partials/base.html.twig */
class __TwigTemplate_c9e1feb4333f0b4a102b9dc0fd656c6697c6f463507699b1a0c3f9786fc8b1af extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $_trait_0 = $this->loadTemplate("blocks/base.html.twig", "partials/base.html.twig", 4);
        // line 4
        if (!$_trait_0->isTraitable()) {
            throw new RuntimeError('Template "'."blocks/base.html.twig".'" cannot be used as a trait.', 4, $this->getSourceContext());
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            [
                'head' => [$this, 'block_head'],
                'stylesheets' => [$this, 'block_stylesheets'],
                'javascripts' => [$this, 'block_javascripts'],
                'assets' => [$this, 'block_assets'],
                'body_classes' => [$this, 'block_body_classes'],
                'header' => [$this, 'block_header'],
                'header_navigation' => [$this, 'block_header_navigation'],
                'hero' => [$this, 'block_hero'],
                'body' => [$this, 'block_body'],
                'messages' => [$this, 'block_messages'],
                'footer' => [$this, 'block_footer'],
                'mobile' => [$this, 'block_mobile'],
                'bottom' => [$this, 'block_bottom'],
            ]
        );
        $this->deferred = $this->env->getExtension('Twig\DeferredExtension\DeferredExtension');
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $context["body_classes"] = $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->bodyClassFunc($context, [0 => "header-fixed", 1 => "header-animated", 2 => "header-dark", 3 => "header-transparent", 4 => "sticky-footer"]);
        // line 2
        $context["grid_size"] = $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->themeVarFunc($context, "grid-size");
        // line 3
        $context["compress"] = (($this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->themeVarFunc($context, "production-mode")) ? (".min.css") : (".css"));
        // line 5
        echo "<!DOCTYPE html>
<html lang=\"";
        // line 6
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "language", []), "getActive", [])) ? ($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "language", []), "getActive", [])) : ($this->getAttribute($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "config", []), "site", []), "default_lang", []))), "html", null, true);
        echo "\">
<head>
";
        // line 8
        $this->displayBlock('head', $context, $blocks);
        // line 24
        echo "
";
        // line 25
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 33
        echo "
";
        // line 34
        $this->displayBlock('javascripts', $context, $blocks);
        // line 39
        echo "
";
        // line 40
        $this->displayBlock('assets', $context, $blocks);
        // line 44
        echo "</head>
<body id=\"top\" class=\"";
        // line 45
        $this->displayBlock('body_classes', $context, $blocks);
        echo "\">
    <div id=\"page-wrapper\">
    ";
        // line 47
        $this->displayBlock('header', $context, $blocks);
        // line 81
        echo "
    ";
        // line 82
        $this->displayBlock('hero', $context, $blocks);
        // line 83
        echo "
        <section id=\"start\">
        ";
        // line 85
        $this->displayBlock('body', $context, $blocks);
        // line 95
        echo "        </section>

    </div>

    ";
        // line 99
        $this->displayBlock('footer', $context, $blocks);
        // line 102
        echo "
    ";
        // line 103
        $this->displayBlock('mobile', $context, $blocks);
        // line 115
        echo "
";
        // line 116
        $this->displayBlock('bottom', $context, $blocks);
        // line 119
        echo "
</body>
</html>
";
        $this->deferred->resolve($this, $context, $blocks);
    }

    public function block_head($context, array $blocks = [])
    {
        $this->deferred->defer($this, 'head');
    }

    // line 8
    public function block_head_deferred($context, array $blocks = [])
    {
        // line 9
        echo "    <meta charset=\"utf-8\" />
    <title>";
        // line 10
        if ($this->getAttribute(($context["page"] ?? null), "title", [])) {
            echo twig_escape_filter($this->env, $this->getAttribute(($context["page"] ?? null), "title", []), "html");
            echo " | ";
        }
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site"] ?? null), "title", []), "html");
        echo "</title>

    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    ";
        // line 14
        $this->loadTemplate("partials/metadata.html.twig", "partials/base.html.twig", 14)->display($context);
        // line 15
        echo "
    <link rel=\"icon\" type=\"image/png\" href=\"/images/favicon/favicon-96x96.png\" sizes=\"96x96\" />
    <link rel=\"icon\" type=\"image/svg+xml\" href=\"/images/favicon/favicon.svg\" />
    <link rel=\"shortcut icon\" href=\"/images/favicon/favicon.ico\" />
    <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"/images/favicon/apple-touch-icon.png\" />
    <meta name=\"apple-mobile-web-app-title\" content=\"Ross Kelso\" />
    <link rel=\"manifest\" href=\"/images/favicon/site.webmanifest\" />
    <link rel=\"canonical\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute(($context["page"] ?? null), "url", [0 => true, 1 => true], "method"), "html", null, true);
        echo "\" />
";
        $this->deferred->resolve($this, $context, $blocks);
    }

    // line 25
    public function block_stylesheets($context, array $blocks = [])
    {
        // line 26
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => ("theme://css-compiled/spectre" . ($context["compress"] ?? null))], "method");
        // line 27
        echo "    ";
        if ($this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->themeVarFunc($context, "spectre.exp")) {
            $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => ("theme://css-compiled/spectre-exp" . ($context["compress"] ?? null))], "method");
        }
        // line 28
        echo "    ";
        if ($this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->themeVarFunc($context, "spectre.icons")) {
            $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => ("theme://css-compiled/spectre-icons" . ($context["compress"] ?? null))], "method");
        }
        // line 29
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => ("theme://css-compiled/theme" . ($context["compress"] ?? null))], "method");
        // line 30
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => "theme://css/custom.css"], "method");
        // line 31
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => "theme://css/line-awesome.min.css"], "method");
    }

    // line 34
    public function block_javascripts($context, array $blocks = [])
    {
        // line 35
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addJs", [0 => "jquery", 1 => 101], "method");
        // line 36
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addJs", [0 => "theme://js/jquery.treemenu.js", 1 => ["group" => "bottom"]], "method");
        // line 37
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addJs", [0 => "theme://js/site.js", 1 => ["group" => "bottom"]], "method");
    }

    public function block_assets($context, array $blocks = [])
    {
        $this->deferred->defer($this, 'assets');
    }

    // line 40
    public function block_assets_deferred($context, array $blocks = [])
    {
        // line 41
        echo "    ";
        echo $this->getAttribute(($context["assets"] ?? null), "css", [], "method");
        echo "
    ";
        // line 42
        echo $this->getAttribute(($context["assets"] ?? null), "js", [], "method");
        echo "
";
        $this->deferred->resolve($this, $context, $blocks);
    }

    // line 45
    public function block_body_classes($context, array $blocks = [])
    {
        echo twig_escape_filter($this->env, ($context["body_classes"] ?? null), "html", null, true);
    }

    // line 47
    public function block_header($context, array $blocks = [])
    {
        // line 48
        echo "        <section id=\"header\" class=\"section\">
            <section class=\"container ";
        // line 49
        echo twig_escape_filter($this->env, ($context["grid_size"] ?? null), "html", null, true);
        echo "\">
                <nav class=\"navbar\">
                    <section class=\"navbar-section logo\">
                        ";
        // line 52
        $this->loadTemplate("partials/logo.html.twig", "partials/base.html.twig", 52)->display($context);
        // line 53
        echo "                    </section>
                    <section class=\"navbar-section\">
                        <span class=\"navbar-brand\">Ross Kelso</span>
                    </section>
                    <section class=\"navbar-section desktop-menu\">

                        <nav class=\"dropmenu animated\">
                        ";
        // line 60
        $this->displayBlock('header_navigation', $context, $blocks);
        // line 63
        echo "                        </nav>

                        ";
        // line 65
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "login", []), "enabled", []) && $this->getAttribute($this->getAttribute(($context["grav"] ?? null), "user", []), "username", []))) {
            // line 66
            echo "                            <span class=\"login-status-wrapper\"><i class=\"fa fa-user\"></i> ";
            $this->loadTemplate("partials/login-status.html.twig", "partials/base.html.twig", 66)->display($context);
            echo "</span>
                        ";
        }
        // line 68
        echo "
                    </section>
                </nav>
            </section>
        </section>
        <div class=\"mobile-menu\">
            <div class=\"button_container\" id=\"toggle\">
                <span class=\"top\"></span>
                <span class=\"middle\"></span>
                <span class=\"bottom\"></span>
            </div>
        </div>
    ";
    }

    // line 60
    public function block_header_navigation($context, array $blocks = [])
    {
        // line 61
        echo "                            ";
        $this->loadTemplate("partials/navigation.html.twig", "partials/base.html.twig", 61)->display($context);
        // line 62
        echo "                        ";
    }

    // line 82
    public function block_hero($context, array $blocks = [])
    {
    }

    // line 85
    public function block_body($context, array $blocks = [])
    {
        // line 86
        echo "            <section id=\"body-wrapper\" class=\"section\">
                <section class=\"container ";
        // line 87
        echo twig_escape_filter($this->env, ($context["grid_size"] ?? null), "html", null, true);
        echo "\">
                    ";
        // line 88
        $this->displayBlock('messages', $context, $blocks);
        // line 91
        echo "                    ";
        $this->displayBlock("content_surround", $context, $blocks);
        echo "
                </section>
            </section>
        ";
    }

    // line 88
    public function block_messages($context, array $blocks = [])
    {
        // line 89
        echo "                        ";
        $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = null;
        try {
            $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 =             $this->loadTemplate("partials/messages.html.twig", "partials/base.html.twig", 89);
        } catch (LoaderError $e) {
            // ignore missing template
        }
        if ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) {
            $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4->display($context);
        }
        // line 90
        echo "                    ";
    }

    // line 99
    public function block_footer($context, array $blocks = [])
    {
        // line 100
        echo "        ";
        $this->loadTemplate("partials/footer.html.twig", "partials/base.html.twig", 100)->display($context);
        // line 101
        echo "    ";
    }

    // line 103
    public function block_mobile($context, array $blocks = [])
    {
        // line 104
        echo "    <div class=\"mobile-container\">
        <div class=\"overlay\" id=\"overlay\">
            <div class=\"mobile-logo\">
                ";
        // line 107
        $this->loadTemplate("partials/logo.html.twig", "partials/base.html.twig", 107)->display(twig_array_merge($context, ["mobile" => true]));
        // line 108
        echo "            </div>
            <nav class=\"overlay-menu\">
                ";
        // line 110
        $this->loadTemplate("partials/navigation.html.twig", "partials/base.html.twig", 110)->display(twig_array_merge($context, ["tree" => true]));
        // line 111
        echo "            </nav>
        </div>
    </div>
    ";
    }

    // line 116
    public function block_bottom($context, array $blocks = [])
    {
        // line 117
        echo "    ";
        echo $this->getAttribute(($context["assets"] ?? null), "js", [0 => "bottom"], "method");
        echo "
";
    }

    public function getTemplateName()
    {
        return "partials/base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  384 => 117,  381 => 116,  374 => 111,  372 => 110,  368 => 108,  366 => 107,  361 => 104,  358 => 103,  354 => 101,  351 => 100,  348 => 99,  344 => 90,  333 => 89,  330 => 88,  321 => 91,  319 => 88,  315 => 87,  312 => 86,  309 => 85,  304 => 82,  300 => 62,  297 => 61,  294 => 60,  278 => 68,  272 => 66,  270 => 65,  266 => 63,  264 => 60,  255 => 53,  253 => 52,  247 => 49,  244 => 48,  241 => 47,  235 => 45,  228 => 42,  223 => 41,  220 => 40,  210 => 37,  207 => 36,  204 => 35,  201 => 34,  196 => 31,  193 => 30,  190 => 29,  185 => 28,  180 => 27,  177 => 26,  174 => 25,  167 => 22,  158 => 15,  156 => 14,  145 => 10,  142 => 9,  139 => 8,  126 => 119,  124 => 116,  121 => 115,  119 => 103,  116 => 102,  114 => 99,  108 => 95,  106 => 85,  102 => 83,  100 => 82,  97 => 81,  95 => 47,  90 => 45,  87 => 44,  85 => 40,  82 => 39,  80 => 34,  77 => 33,  75 => 25,  72 => 24,  70 => 8,  65 => 6,  62 => 5,  60 => 3,  58 => 2,  56 => 1,  25 => 4,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% set body_classes = body_class(['header-fixed', 'header-animated', 'header-dark', 'header-transparent', 'sticky-footer']) %}
{% set grid_size = theme_var('grid-size') %}
{% set compress = theme_var('production-mode') ? '.min.css' : '.css' %}
{% use 'blocks/base.html.twig' %}
<!DOCTYPE html>
<html lang=\"{{ grav.language.getActive ?: grav.config.site.default_lang }}\">
<head>
{% block head deferred %}
    <meta charset=\"utf-8\" />
    <title>{% if page.title %}{{ page.title|e('html') }} | {% endif %}{{ site.title|e('html') }}</title>

    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    {% include 'partials/metadata.html.twig' %}

    <link rel=\"icon\" type=\"image/png\" href=\"/images/favicon/favicon-96x96.png\" sizes=\"96x96\" />
    <link rel=\"icon\" type=\"image/svg+xml\" href=\"/images/favicon/favicon.svg\" />
    <link rel=\"shortcut icon\" href=\"/images/favicon/favicon.ico\" />
    <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"/images/favicon/apple-touch-icon.png\" />
    <meta name=\"apple-mobile-web-app-title\" content=\"Ross Kelso\" />
    <link rel=\"manifest\" href=\"/images/favicon/site.webmanifest\" />
    <link rel=\"canonical\" href=\"{{ page.url(true, true) }}\" />
{% endblock head %}

{% block stylesheets %}
    {% do assets.addCss('theme://css-compiled/spectre'~compress) %}
    {% if theme_var('spectre.exp') %}{% do assets.addCss('theme://css-compiled/spectre-exp'~compress)  %}{% endif %}
    {% if theme_var('spectre.icons') %}{%  do assets.addCss('theme://css-compiled/spectre-icons'~compress) %}{% endif %}
    {% do assets.addCss('theme://css-compiled/theme'~compress) %}
    {% do assets.addCss('theme://css/custom.css') %}
    {% do assets.addCss('theme://css/line-awesome.min.css') %}
{% endblock %}

{% block javascripts %}
    {% do assets.addJs('jquery', 101) %}
    {% do assets.addJs('theme://js/jquery.treemenu.js', {group:'bottom'}) %}
    {% do assets.addJs('theme://js/site.js', {group:'bottom'}) %}
{% endblock %}

{% block assets deferred %}
    {{ assets.css()|raw }}
    {{ assets.js()|raw }}
{% endblock %}
</head>
<body id=\"top\" class=\"{% block body_classes %}{{ body_classes }}{% endblock %}\">
    <div id=\"page-wrapper\">
    {% block header %}
        <section id=\"header\" class=\"section\">
            <section class=\"container {{ grid_size }}\">
                <nav class=\"navbar\">
                    <section class=\"navbar-section logo\">
                        {% include 'partials/logo.html.twig' %}
                    </section>
                    <section class=\"navbar-section\">
                        <span class=\"navbar-brand\">Ross Kelso</span>
                    </section>
                    <section class=\"navbar-section desktop-menu\">

                        <nav class=\"dropmenu animated\">
                        {% block header_navigation %}
                            {% include 'partials/navigation.html.twig' %}
                        {% endblock %}
                        </nav>

                        {% if config.plugins.login.enabled and grav.user.username %}
                            <span class=\"login-status-wrapper\"><i class=\"fa fa-user\"></i> {% include 'partials/login-status.html.twig' %}</span>
                        {% endif %}

                    </section>
                </nav>
            </section>
        </section>
        <div class=\"mobile-menu\">
            <div class=\"button_container\" id=\"toggle\">
                <span class=\"top\"></span>
                <span class=\"middle\"></span>
                <span class=\"bottom\"></span>
            </div>
        </div>
    {% endblock %}

    {% block hero %}{% endblock %}

        <section id=\"start\">
        {% block body %}
            <section id=\"body-wrapper\" class=\"section\">
                <section class=\"container {{ grid_size }}\">
                    {% block messages %}
                        {% include 'partials/messages.html.twig' ignore missing %}
                    {% endblock %}
                    {{ block('content_surround') }}
                </section>
            </section>
        {% endblock %}
        </section>

    </div>

    {% block footer %}
        {% include 'partials/footer.html.twig' %}
    {% endblock %}

    {% block mobile %}
    <div class=\"mobile-container\">
        <div class=\"overlay\" id=\"overlay\">
            <div class=\"mobile-logo\">
                {% include 'partials/logo.html.twig' with {mobile: true} %}
            </div>
            <nav class=\"overlay-menu\">
                {% include 'partials/navigation.html.twig' with {tree: true} %}
            </nav>
        </div>
    </div>
    {% endblock %}

{% block bottom %}
    {{ assets.js('bottom')|raw }}
{% endblock %}

</body>
</html>
", "partials/base.html.twig", "/var/www/html/user/themes/quark/templates/partials/base.html.twig");
    }
    private $deferred;
}
