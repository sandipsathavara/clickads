<?php use_helper('I18N', 'Date') ?>
<div class="block">
    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        <h2>Import Location</h2>
    </div>
    <div class="block_content">
        <?php echo form_tag('@location_import', array('name' => 'countries', 'multipart' => true)); ?>
        <p></p>
        <?php foreach ($objLang as $k => $v) : ?>
            <p>
                <label> Import in <?php echo $v['name']; ?> :</label> 
                <?php echo $objForm['file_'.$v['culture']]->render(array('id' => 'file_'.$v['culture'], 'class' => 'file')); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?php echo $objForm['file_'.$v['culture']]->renderError(array('class' => 'errorField')); ?>
            </p>
        <?php endforeach; ?>

        <p>
            <input type="submit" class="submit big" value="Import" />
        </p>
        </form>

    </div>
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>