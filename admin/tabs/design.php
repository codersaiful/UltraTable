<div class="ultraaddons-panel">
    <table class="ultraaddons-table">
        <tr>
            <th>
                <label>Table Wrapper Style</label>
            </th>
            <td>
                <?php
                /**
 * For CSS Style Area for Each Column
 */
do_action( 'ultratable_admin_style_area', 'data', $supported_css_property, 'main-wrapper', $data, false, $data, $post );

                ?>
            </td>
        </tr>
    </table>
</div>