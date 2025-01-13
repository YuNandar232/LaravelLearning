

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    New Task
                </div>

                <div class="card-body">
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <!-- New Task Form -->
                    <form action="<?php echo e(route('tasks.store')); ?>" method="POST" class="form-horizontal">
                        <?php echo csrf_field(); ?>

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-form-label">Task</label>

                            <div class="col mb-2">
                                <input type="text" name="name" id="task-name" class="form-control" value="<?php echo e(old('name')); ?>">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            <?php if(count($tasks) > 0): ?>
            <div class="card mt-3">
                <div class="card-header">
                    Current Tasks
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>Task</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($task->name); ?></td>
                                <td class="text-end">
                                    <!-- Add the class "text-end" -->
                                    <form action="<?php echo e(route('tasks.destroy', $task->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\QPass PHP\Learning Laravel\task-list-app\resources\views/tasks.blade.php ENDPATH**/ ?>