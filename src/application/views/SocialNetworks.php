<div class="row share">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$config['link']?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
        <img src="/public/img/facebook.jpeg" alt="facebook">
    </a>
    <a href="http://twitter.com/share?&url=<?=$config['link']?>&text=<?=$config['text']?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
        <img src="/public/img/twitter.jpeg" alt="twitter">
    </a>
</div>
<div class="row">
    <div class="col">
        <a href="/participants" class="float-right">All members (<?= $countUser['total'] ?>)</a>
    </div>
</div>
