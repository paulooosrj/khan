<?php

/* index.html */
class __TwigTemplate_1559091df42bd57bdcd07209ef92a94822f410d3df53376ea04124348991eb11 extends Twig_Template
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
        return "index.html";
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
        return new Twig_Source("", "index.html", "/home/cabox/workspace/routerphp/views/index.html");
    }
}
