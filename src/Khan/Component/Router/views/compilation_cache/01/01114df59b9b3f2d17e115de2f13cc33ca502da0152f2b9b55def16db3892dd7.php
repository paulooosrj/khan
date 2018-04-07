<?php

/* index.twig */
class __TwigTemplate_d05008b4eceba5ddfbf5d9d098428e52d93d0d8840afe7873e8f1f5c30a7ee86 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\">
  <title>Document</title>
</head>
<body>
  <h1>Testandooo: ";
        // line 8
        echo twig_escape_filter($this->env, ($context["nome"] ?? null), "html", null, true);
        echo "</h1>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 8,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "index.twig", "/home/cabox/workspace/routerphp/views/index.twig");
    }
}
