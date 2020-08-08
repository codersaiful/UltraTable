<?php
$head           = isset( $data['head'] ) ? $data['head'] : 'on';
$checkbox       = $head == 'on' ? 'checked' : '';
?>

<div class="ultraaddons-panel">
    <table class="ultraaddons-table">
        <tr>
            <th>
                <label>Table Head</label>
            </th>
            <td>
                <input type="hidden" name="data[head]" value="<?php echo esc_attr( $head ); ?>" class="head-status">
            
                <label class="switch">
                    <input class="ultratable-placeholder-onoff" data-target="head-status" type="checkbox" <?php echo esc_attr( $checkbox ); ?>>
                    <div class="slider round"><!--ADDED HTML -->
                        <span class="on">ON</span><span class="off">OFF</span><!--END-->
                    </div>
                </label>
            </td>
        </tr>
    </table>
</div>