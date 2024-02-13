<?php
class Zoo {

    private const enclosMax = 10;

    protected $_enclosPosition = array(
        [0, 0]
        ,[10, 20]
        ,[20, 70]
        ,[30, 20]
        ,[40, 60]
        ,[50, 40]
        ,[60, 80]
        ,[70, 40]
        ,[80, 10]
        ,[90, 60]
    );
    public function afficherMap(){
        ?>
        <div class="relative inline-block w-screen overflow-hidden">
            <img src="/images/map.png" class="w-full top-0 left-0"/>
            <?php
            foreach($this->_enclosPosition as $xy){
                ?>
                <div class="enclos bg-black inline-block absolute rotate-45" style="left: <?= $xy[0] ?>%; top: <?= $xy[1] ?>%"></div>
                <?php
            }

            ?>
        </div>
        <?php
    }
}