<tr id="{$ad->getId()}" {if $ad->getType() eq 1}{if $ad->getColor() eq 1}class="success"{/if}{/if} ><td>{$ad->getId()}</td>
                 <td><a href='{$smarty.server.SCRIPT_NAME}?click_id={$ad->getId()}'>{$ad->getTitle()}<a></td>
{*                 <td><a class="display btn">{$ad->getTitle()}<a></td>*}
                 <td>{$ad->getDescription()}</td>
                 <td><a class="delete btn btn-danger">Удалить</a></td>
                 </tr>