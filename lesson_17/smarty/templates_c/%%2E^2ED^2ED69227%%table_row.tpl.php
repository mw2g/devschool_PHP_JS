<?php /* Smarty version 2.6.25-dev, created on 2016-02-12 14:12:00
         compiled from table_row.tpl */ ?>
<tr id="<?php echo $this->_tpl_vars['ad']->getId(); ?>
" <?php if ($this->_tpl_vars['ad']->getType() == 1): ?><?php if ($this->_tpl_vars['ad']->getColor() == 1): ?>class="warning"<?php endif; ?><?php endif; ?> ><td><?php echo $this->_tpl_vars['ad']->getId(); ?>
</td>
                 <td><?php echo $this->_tpl_vars['ad']->getTitle(); ?>
</td>
                 <td><?php echo $this->_tpl_vars['ad']->getDescription(); ?>
</td>
                 <td><a class="open btn btn-success">Открыть</a></td>
                 <td><a class="delete btn btn-danger">Удалить</a></td>
                 </tr>