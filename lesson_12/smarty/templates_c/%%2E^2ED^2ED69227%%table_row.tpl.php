<?php /* Smarty version 2.6.25-dev, created on 2016-02-04 18:42:53
         compiled from table_row.tpl */ ?>
<tr <?php if ($this->_tpl_vars['ad']->getType() == 1): ?><?php if ($this->_tpl_vars['ad']->getColor() == 1): ?>class="success"<?php endif; ?><?php endif; ?> ><td><?php echo $this->_tpl_vars['ad']->getId(); ?>
</td>
                 <td><a href='<?php echo $_SERVER['SCRIPT_NAME']; ?>
?click_id=<?php echo $this->_tpl_vars['ad']->getId(); ?>
'><?php echo $this->_tpl_vars['ad']->getTitle(); ?>
<a></td>
                 <td><?php echo $this->_tpl_vars['ad']->getDescription(); ?>
</td>
                 <td><a href='<?php echo $_SERVER['SCRIPT_NAME']; ?>
?del_ad=<?php echo $this->_tpl_vars['ad']->getId(); ?>
'>Удалить</a></td>
                 </tr>