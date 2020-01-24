<?php /* Smarty version 2.6.25-dev, created on 2016-02-12 04:17:54
         compiled from table.tpl */ ?>
<h3 align="center" class="sub-header">Все объявления</h3>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#id</th>
                  <th>Название</th>
                  <th>Описание</th>
                  <th>Действия</th>
                </tr>
              </thead>
              <tbody>
                 <?php echo $this->_tpl_vars['ads_rows']; ?>

              
              </tbody>
            </table>
          </div>