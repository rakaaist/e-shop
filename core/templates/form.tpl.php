<form <?php print form($form['attr']); ?>>
    <?php foreach ($form['fields'] as $field_id => $field): ?>
        <label>
            <?php print $field['label']; ?><br>
            <?php if ($field['type'] == 'select'): ?>
                <select <?php print select_attr($field_id, $field); ?>>
                    <?php foreach ($field['options'] as $option_id => $option_title): ?>
                        <option <?php print option_attr($option_id, $field); ?>>
                            <?php print $option_title; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php elseif ($field['type'] == 'textarea'): ?>
                <textarea <?php print textarea_attr($field_id, $field); ?>><?php print $field['value'] ?? ''; ?></textarea>
            <?php else: ?>
                <input <?php print input_attr($field_id, $field); ?>>
            <?php endif; ?>
            <?php if (isset($field['error'])): ?>
                <p class="error"><?php print $field['error']; ?></p>
            <?php endif; ?>
        </label>
    <?php endforeach; ?>
    <?php foreach ($form['buttons'] as $button_name => $button): ?>
        <button <?php print button_attr($button_name, $button); ?>>
            <?php print $button['title']; ?>
        </button>
    <?php endforeach; ?>
</form>
