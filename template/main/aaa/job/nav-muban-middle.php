<!-- //nav-where-middle -->
<div class="jianli-where-middle">
    <div class="jianli-middle-border">
        <div class="jianli-middle">
            <div class="jianli-middle-left">
                求职意向
            </div>
            <div class="jianli-middle-right">
                <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban_detail/iid/0')); ?>" class="current">不限</a>
                <?php

                foreach($intention as $k => $v) {
                ?>
                <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban_detail/iid/' . $v[0])); ?>"><?php echo $v[1]; ?></a>
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
                    <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban_detail/tid/0')); ?>" class="current">不限</a>
                    <?php
                    foreach($type as $k => $v) {
                        ?>
                        <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban_detail/tid/' . $v['0'])); ?>" ><?php echo $v[1]; ?></a>
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
                    <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban_detail/lid/0')); ?>" class="current">不限</a>
                    <?php
                    foreach($language as $k => $v) {
                        ?>
                        <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban_detail/lid/' . $v[0])); ?>"><?php echo $v[1]; ?></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- nav-where-middle// -->

