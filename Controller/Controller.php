<?php

namespace Controller;




use View\View;

interface Controller
{
  public function requireData();
  public function draw(View $view);

}