jQuery(document).ready(function($){
    // Add / remove list items (activities, objectives, results)
    function bindRemove(){
        $('.cs-remove-item').off('click').on('click', function(e){
            e.preventDefault();
            $(this).closest('.cs-list-item').remove();
        });
    }
    bindRemove();
    $('#cs-add-activity').on('click', function(){ $('#cs-activities-list').append('<div class="cs-list-item"><input type="text" name="activities[]" class="regular-text"> <button class="button cs-remove-item">ลบ</button></div>'); bindRemove(); });
    $('#cs-add-objective').on('click', function(){ $('#cs-objectives-list').append('<div class="cs-list-item"><input type="text" name="objectives[]" class="regular-text"> <button class="button cs-remove-item">ลบ</button></div>'); bindRemove(); });
    $('#cs-add-result').on('click', function(){ $('#cs-results-list').append('<div class="cs-list-item"><input type="text" name="results[]" class="regular-text"> <button class="button cs-remove-item">ลบ</button></div>'); bindRemove(); });

    // attachments add/remove
    $('#cs-add-attachment').on('click', function(){
        $('#cs-attachments-list').append('<div class="cs-attachment-item"><input type="text" name="cs_attachments[]" class="regular-text"> <button class="button cs-remove-attach">ลบ</button></div>');
    });
    $(document).on('click','.cs-remove-attach', function(e){ e.preventDefault(); $(this).closest('.cs-attachment-item').remove(); });

    // Gallery using WP media frame (multiple select)
    var frame;
    $('#cs-add-gallery').on('click', function(e){
        e.preventDefault();
        if (frame) frame.open();
        frame = wp.media({
            title: 'เลือก/อัปโหลดรูปกิจกรรม',
            button: { text: 'เลือกรูป' },
            multiple: true
        });
        frame.on('select', function(){
            var selection = frame.state().get('selection');
            var ids = [];
            selection.each(function(attachment){
                var obj = attachment.toJSON();
                ids.push(obj.id);
                var thumb = obj.sizes && obj.sizes.thumbnail ? obj.sizes.thumbnail.url : obj.url;
                $('.cs-gallery-previews').append('<div class="cs-gallery-item" data-id="'+obj.id+'"><img src="'+thumb+'" alt=""><button class="button cs-remove-gallery">ลบ</button></div>');
            });
            // update hidden field (append)
            var cur = $('#cs_gallery_ids_field').val();
            var curArr = cur ? cur.split(',').filter(Boolean) : [];
            var newArr = curArr.concat(ids.map(String));
            $('#cs_gallery_ids_field').val(newArr.join(','));
        });
        frame.open();
    });

    // remove gallery item
    $(document).on('click', '.cs-remove-gallery', function(e){
        e.preventDefault();
        var item = $(this).closest('.cs-gallery-item');
        var id = item.data('id').toString();
        item.remove();
        var cur = $('#cs_gallery_ids_field').val().split(',').filter(Boolean);
        var newArr = cur.filter(function(x){ return x !== id; });
        $('#cs_gallery_ids_field').val(newArr.join(','));
    });
});