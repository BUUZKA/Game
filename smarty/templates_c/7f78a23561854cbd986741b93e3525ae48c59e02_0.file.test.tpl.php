<?php
/* Smarty version 3.1.39, created on 2021-03-23 12:51:04
  from 'C:\xampp\htdocs\genericBrowserGame\smarty\templates\test.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6059d6289795a0_37128157',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f78a23561854cbd986741b93e3525ae48c59e02' => 
    array (
      0 => 'C:\\xampp\\htdocs\\genericBrowserGame\\smarty\\templates\\test.tpl',
      1 => 1616500260,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_6059d6289795a0_37128157 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    Cześć <?php echo $_smarty_tpl->tpl_vars['imie']->value;?>
!
</body>
</html><?php }
}
