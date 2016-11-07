<?php //echo "<pre>"; var_dump($data); echo "</pre>";exit();?>

<header class="intro-header" style="background-image: url('public/img/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Danh sách bài viết </h1>
                    <hr class="small">
                    <span class="subheading">SML</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php foreach ($data as $d): ?>
                <div class="post-preview">
                    <a href="<?php echo BASE_PATH; ?>/post/<?php echo $d['id'] ?>">
                        <!--                        localhost/mvc-routes/post/2-->
                        <h2 class="post-title">
                            <?php echo $d['title'] ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?php echo substr($d['content'], 0, 50); ?>
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <a href="#"><?php echo $d['user_name'] ?>
                            on <?php echo $d['created_time']; ?></p>
                    </a>
                </div>
                <hr>
            <?php endforeach; ?>

            <!-- Pager -->
            <ul class="pager">
                <?php if ($current_page > 1) :?>
                    <li class="prev">
                        <a style="float: left" href="?page=<?php echo($current_page - 1) ?>">&#x2190;  Newwer Posts </a>
                    </li>
                <?php endif; ?>
                <!-- Nghiên cứu kỹ lại và viết lại nó ! -->
                <?php
                  for ($i=1; $i <= $total_page ; $i++) {
                    if ($i == $current_page) {
                      echo "<li><a>".$i."</a></li>";
                    }else{
                      echo '<li><a href="post?page='.$i.'">'.$i.'</a></li>';
                    }
                  }
                 ?>
                <?php if ($current_page < $total_page) : ?>
                    <li class="next">
                        <a href="?page=<?php echo($current_page + 1) ?>">Older Posts →</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<hr>

