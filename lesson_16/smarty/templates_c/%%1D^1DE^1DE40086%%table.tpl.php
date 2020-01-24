<?php /* Smarty version 2.6.25-dev, created on 2016-02-12 14:30:30
         compiled from table.tpl */ ?>
            <h3 align="center" class="sub-header">Доска объявлений</h3>
          <div id="tableAds" class="table-responsive" style="display: none">
            <table id="ads" class="table table-striped">
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