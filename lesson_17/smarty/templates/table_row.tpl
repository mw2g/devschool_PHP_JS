<tr id="{$ad->getId()}" {if $ad->getType() eq 1}{if $ad->getColor() eq 1}class="warning"{/if}{/if} ><td>{$ad->getId()}</td>
                 <td>{$ad->getTitle()}</td>
                 <td>{$ad->getDescription()}</td>
                 <td><a class="open btn btn-success">Открыть</a></td>
                 <td><a class="delete btn btn-danger">Удалить</a></td>
                 </tr>