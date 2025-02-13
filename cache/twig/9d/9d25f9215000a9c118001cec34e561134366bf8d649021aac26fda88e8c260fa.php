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

/* sitemap.xml.twig */
class __TwigTemplate_0b94adcff1b324114911bc3b726e6ee18517e829435ec0dcb04853aba689b65a extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
";
        // line 2
        if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "sitemap", []), "xsl_transform", [])) {
            // line 3
            echo "<?xml-stylesheet type=\"text/xsl\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["uri"] ?? null), "rootUrl", []), "html", null, true);
            echo "/user/plugins/sitemap/sitemap.xsl\"?>
";
        }
        // line 5
        echo "<urlset
  xmlns=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "sitemap", []), "urlset", []), "html", null, true);
        echo "\"
  xmlns:xhtml=\"http://www.w3.org/1999/xhtml\"
  xmlns:image=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "sitemap", []), "urlimageset", []), "html", null, true);
        echo "\"
";
        // line 9
        if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "sitemap", []), "include_news_tags", [])) {
            // line 10
            echo "  xmlns:news=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "sitemap", []), "urlnewsset", []), "html", null, true);
            echo "\"
";
        }
        // line 11
        echo ">
";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sitemap"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["entry"]) {
            // line 13
            echo "  <url>
    <loc>";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["entry"], "location", []));
            echo "</loc>
  ";
            // line 15
            if (((($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "sitemap", []), "include_news_tags", []) && ($this->getAttribute($this->getAttribute($this->getAttribute(            // line 16
($context["config"] ?? null), "plugins", []), "sitemap", []), "standalone_sitemap_news", []) == false)) && call_user_func_array($this->env->getFunction('timestamp_within_days')->getCallable(), [$this->getAttribute(            // line 17
$context["entry"], "timestamp", []), (($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugin", [], "any", false, true), "sitemap", [], "any", false, true), "news_max_age_days", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugin", [], "any", false, true), "sitemap", [], "any", false, true), "news_max_age_days", []), 2)) : (2))])) && $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->startsWithFilter($this->getAttribute(            // line 18
$context["entry"], "rawroute", []), $this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "sitemap", []), "news_enabled_paths", [])))) {
                // line 20
                echo "    ";
                $this->loadTemplate("sitemap-extensions/news.xml.twig", "sitemap.xml.twig", 20)->display($context);
                // line 21
                echo "  ";
            }
            // line 22
            echo "  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["entry"], "hreflangs", []));
            foreach ($context['_seq'] as $context["_key"] => $context["hreflang"]) {
                // line 23
                echo "    <xhtml:link rel=\"alternate\" hreflang=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["hreflang"], "hreflang", []), "html", null, true);
                echo "\" href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["hreflang"], "href", []), "html", null, true);
                echo "\" />
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['hreflang'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "  ";
            if ($this->getAttribute($context["entry"], "lastmod", [])) {
                // line 26
                echo "    <lastmod>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["entry"], "lastmod", []), "html", null, true);
                echo "</lastmod>
  ";
            }
            // line 28
            echo "  ";
            if ($this->getAttribute($context["entry"], "changefreq", [])) {
                // line 29
                echo "    <changefreq>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["entry"], "changefreq", []), "html", null, true);
                echo "</changefreq>
  ";
            }
            // line 31
            echo "  ";
            if ($this->getAttribute($context["entry"], "priority", [])) {
                // line 32
                echo "    <priority>";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["entry"], "priority", []), 1), "html", null, true);
                echo "</priority>
  ";
            }
            // line 34
            echo "  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["entry"], "images", []));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 35
                echo "    ";
                $this->loadTemplate("sitemap-extensions/image.xml.twig", "sitemap.xml.twig", 35)->display($context);
                // line 36
                echo "  ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "  </url>
";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entry'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "</urlset>
";
    }

    public function getTemplateName()
    {
        return "sitemap.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  192 => 39,  177 => 37,  163 => 36,  160 => 35,  142 => 34,  136 => 32,  133 => 31,  127 => 29,  124 => 28,  118 => 26,  115 => 25,  104 => 23,  99 => 22,  96 => 21,  93 => 20,  91 => 18,  90 => 17,  89 => 16,  88 => 15,  84 => 14,  81 => 13,  64 => 12,  61 => 11,  55 => 10,  53 => 9,  49 => 8,  44 => 6,  41 => 5,  35 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<?xml version=\"1.0\" encoding=\"UTF-8\"?>
{% if config.plugins.sitemap.xsl_transform %}
<?xml-stylesheet type=\"text/xsl\" href=\"{{ uri.rootUrl }}/user/plugins/sitemap/sitemap.xsl\"?>
{% endif %}
<urlset
  xmlns=\"{{ config.plugins.sitemap.urlset }}\"
  xmlns:xhtml=\"http://www.w3.org/1999/xhtml\"
  xmlns:image=\"{{ config.plugins.sitemap.urlimageset }}\"
{% if config.plugins.sitemap.include_news_tags %}
  xmlns:news=\"{{ config.plugins.sitemap.urlnewsset }}\"
{% endif %}>
{% for entry in sitemap %}
  <url>
    <loc>{{ entry.location|e }}</loc>
  {% if config.plugins.sitemap.include_news_tags and
        config.plugins.sitemap.standalone_sitemap_news == false and
        timestamp_within_days(entry.timestamp, config.plugin.sitemap.news_max_age_days|default(2)) and
        entry.rawroute|starts_with(config.plugins.sitemap.news_enabled_paths)
  %}
    {% include 'sitemap-extensions/news.xml.twig' %}
  {% endif %}
  {% for hreflang in entry.hreflangs %}
    <xhtml:link rel=\"alternate\" hreflang=\"{{ hreflang.hreflang }}\" href=\"{{ hreflang.href }}\" />
  {% endfor %}
  {% if entry.lastmod %}
    <lastmod>{{ entry.lastmod }}</lastmod>
  {% endif %}
  {% if entry.changefreq %}
    <changefreq>{{ entry.changefreq }}</changefreq>
  {% endif %}
  {% if entry.priority %}
    <priority>{{ entry.priority|number_format(1) }}</priority>
  {% endif %}
  {% for image in entry.images %}
    {% include 'sitemap-extensions/image.xml.twig' %}
  {% endfor %}
  </url>
{% endfor %}
</urlset>
", "sitemap.xml.twig", "/var/www/html/user/plugins/sitemap/templates/sitemap.xml.twig");
    }
}
