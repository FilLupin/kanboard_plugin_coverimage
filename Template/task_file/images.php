<?php if (! empty($images)): ?>

<?php 
$cover_id = $this->container['coverimage']->getCoverimage($task['id']);
//print_r( $this->container );
?>


    <div class="file-thumbnails">
        <?php foreach ($images as $file): ?>
            <div class="file-thumbnail">
                <a href="<?= $this->url->href('FileViewer', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id'], 'file_id' => $file['id'])) ?>" class="popover"><img src="<?= $this->url->href('FileViewer', 'thumbnail', array('file_id' => $file['id'], 'project_id' => $task['project_id'], 'task_id' => $file['task_id'])) ?>" title="<?= $this->text->e($file['name']) ?>" alt="<?= $this->text->e($file['name']) ?>"></a>
                <div class="file-thumbnail-content">
                    <div class="file-thumbnail-title">
                        <div class="dropdown">
                            <a href="#" class="dropdown-menu dropdown-menu-link-text"><?= $this->text->e($file['name']) ?> <i class="fa fa-caret-down"></i></a>
                            <ul>
                                <li>
                                    <i class="fa fa-download fa-fw"></i>
                                    <?= $this->url->link(t('Download'), 'FileViewer', 'download', array('task_id' => $task['id'], 'project_id' => $task['project_id'], 'file_id' => $file['id'])) ?>
                                </li>
                                <?php if ($this->user->hasProjectAccess('TaskFile', 'remove', $task['project_id'])): ?>
                                    <li>
                                        <i class="fa fa-trash fa-fw"></i>
                                        <?= $this->url->link(t('Remove'), 'TaskFile', 'confirm', array('task_id' => $task['id'], 'project_id' => $task['project_id'], 'file_id' => $file['id']), false, 'popover') ?>
                                    </li>
                                <?php endif ?>
                                <li>
                                    <i class="fa fa-newspaper-o fa-fw"></i>
                                    <?= $this->url->link(t('Coverimage'), 'Coverimage', 'set', array('plugin' => 'coverimage', 'task_id' => $task['id'], 'project_id' => $task['project_id'], 'file_id' => $file['id'])) ?>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="file-thumbnail-description">
                        <?php
                            if($file['id'] == $cover_id){
                              echo  '<i class="fa fa-newspaper-o"></i>';
                            }
                        ?>
                            <span class="tooltip" title='<?= t('Uploaded: %s', $this->dt->datetime($file['date'])).'<br>'.t('Size: %s', $this->text->bytes($file['size'])) ?>'>
                                <i class="fa fa-info-circle"></i>
                            </span>
                        <?= t('Uploaded by %s', $file['user_name'] ?: $file['username']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>