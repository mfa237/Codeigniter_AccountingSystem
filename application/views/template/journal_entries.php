<?php foreach($entries as $entry){ ?>
    <tr>
        <td>
            <select name="accounts[]" class="selectpicker show-tick form-control selectpicker_accounts" data-live-search="true" >
                <?php foreach($accounts as $account){ ?>
                    <option value='<?php echo $account->account_id; ?>' <?php echo ($entry->account_id==$account->account_id?'selected':''); ?> ><?php echo $account->account_title; ?></option>
                <?php } ?>
            </select>
        </td>
        <td><input type="text" name="memo[]" class="form-control"  value="<?php echo $entry->memo; ?>"></td>
        <td><input type="text" name="dr_amount[]" class="form-control numeric" value="<?php echo number_format($entry->dr_amount,2); ?>"></td>
        <td><input type="text" name="cr_amount[]" class="form-control numeric"  value="<?php echo number_format($entry->cr_amount,2);?>"></td>
        <td>
            <button type="button" class="btn btn-default add_account"><i class="fa fa-plus-circle" style="color: green;"></i></button>
            <button type="button" class="btn btn-default remove_account"><i class="fa fa-times-circle" style="color: red;"></i></button>
        </td>
    </tr>
<?php } ?>

