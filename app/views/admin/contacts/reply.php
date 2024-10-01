<div class="p-2">
    <div class="shadow-lg p-2 px-3 rounded-3">
        <?php
        if (!empty($msg)) :
            echo '<div class="alert alert-' . $msgType . '">';
            echo $msg;
            echo '</div>';
        endif;
    ?>
        <form method="post">
            <div class="form-group mt-2">
                <label for="message">Tin nhắn của người dùng</label>
                <textarea name="message" rows="4" class="form-control"
                    disabled><?php echo (!empty($message)) ? $message : ''; ?></textarea>
            </div>
            <div class="form-group mt-2">
                <label for="message">Phản hồi</label>
                <textarea name="reply" rows="6" class="form-control"></textarea>
                <?php echo form_error('reply', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
            </div>
            <div class="py-2">
                <button class="btn btn-danger px-4" type="button">Huỷ</button>
                <button class="btn btn-primary px-5" type="submit">Gửi</button>
            </div>
        </form>
    </div>
</div>