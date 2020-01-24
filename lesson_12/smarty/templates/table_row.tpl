<tr {if $ad->getType() eq 1}{if $ad->getColor() eq 1}class="success"{/if}{/if} ><td>{$ad->getId()}</td>
                 <td><a href='{$smarty.server.SCRIPT_NAME}?click_id={$ad->getId()}'>{$ad->getTitle()}<a></td>
                 <td>{$ad->getDescription()}</td>
                 <td><a href='{$smarty.server.SCRIPT_NAME}?del_ad={$ad->getId()}'>Удалить</a></td>
                 </tr>