<?php

add_action("widgets_init", array('Sponsoren', 'register'));

class Sponsoren {
  function control(){
    echo 'I am a control panel';
  }
  function widget($args){
    echo $args['before_widget'];
    echo $args['before_title'] . 'Your widget title' . $args['after_title'];
    echo 'I am your widget';
    echo $args['after_widget'];
  }
  function register(){
    register_sidebar_widget('Widget name', array('Widget_name', 'widget'));
    register_widget_control('Widget name', array('Widget_name', 'control'));
  }
}

?>