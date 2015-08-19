<!-- //nav-where-middle -->
<div class="jianli-where-middle">
    <div class="jianli-middle-border">
        <div class="jianli-middle">
            <div class="jianli-middle-left">
                求职意向
            </div>
            <div class="jianli-middle-right">
                <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban')); ?>" class="current" id="iid0">不限</a>
                <?php

                foreach($intention as $k => $v) {
                ?>
                <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban/iid/' . $v[0])); ?>" id="<?php echo $v['0'] . 'iid'; ?>"><?php echo $v[1]; ?></a>
                <?php
                }
                ?>
            </div>
        </div>
        <br>
        <div class="jianli-middle">
            <div class="jianli-middle-left">
                模板风格
            </div>
            <div class="jianli-middle-right">
                <div class="jianli-middle-right jianli-left-right-clear">
                    <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban')); ?>" class="current" id="tid0">不限</a>
                    <?php
                    foreach($type as $k => $v) {
                        ?>
                        <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban/tid/' . $v['0'])); ?>" id="<?php echo $v['0'] . 'tid'; ?>"><?php echo $v[1]; ?></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <br>
        <div class="jianli-middle">
            <div class="jianli-middle-left">
                简历语言
            </div>
            <div class="jianli-middle-right jianli-left-right-clear">
                <div class="jianli-middle-right">
                    <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban')); ?>" class="current" id="lid0">不限</a>
                    <?php
                    foreach($language as $k => $v) {
                        ?>
                        <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban/lid/' . $v[0])); ?>" id="<?php echo $v['0'] . 'lid'; ?>"><?php echo $v[1]; ?></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- nav-where-middle// -->

