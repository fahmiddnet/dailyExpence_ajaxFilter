<?php session_start(); if(isset($_SESSION['id']) && isset($_SESSION['user_password'])){ ?>
<?php include('db/connect.php'); include('Layout/header.php'); ?>
<?php

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id = '$user_id'";
$sql_query = mysqli_query($conn, $sql);
$user_info = mysqli_fetch_assoc($sql_query);
$user_name = $user_info['name'];

?>
<section class="date-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4 welcomebox">
                <h2>Welcome <span class="text-success fw-bold text-uppercase"><?php echo $user_name ?></span>. We All happy to see you!!</h2>
            </div>
            <div class="col-md-12">
                <h1 class="text-title">Mastering Your Money: Daily Expenses and Budget Hacks</h1>
                <p>Daily expenses are the costs you incur on a regular basis, often for necessities or small indulgences. These can include things like:</p>
                <ul>
                    <li><span class="text-small-bold">Food and groceries:</span> This is typically the biggest daily expense for most people.</li>
                    <li><span class="text-small-bold">Transportation: </span>The realization of excessive spending can lead to anxiety and stress, affecting overall well-being.</li>
                    <li><span class="text-small-bold">Coffee and snacks:</span> That daily latte or afternoon pick-me-up can add up.</li>
                    <li><span class="text-small-bold">Personal care items:</span> Toiletries, cosmetics, and other hygiene products.</li>
                    <li><span class="text-small-bold">Entertainment: </span> Streaming services, movies, or nights out.</li>
                </ul>
                <p>While seemingly small, daily expenses can significantly impact your overall financial picture.  Effectively managing these costs allows you to:</p>
                <ul>
                    <li><span class="text-small-bold">Save for your goals: </span> Whether it's a dream vacation, a down payment on a house, or a secure retirement, every penny saved brings you closer.</li>
                    <li><span class="text-small-bold">Reduce financial stress: </span>Knowing your spending is under control frees you up to worry less about money.</li>
                    <li><span class="text-small-bold">Gain financial freedom: </span> By managing daily expenses, you have more control over your financial future.</li>
                </ul>

                <p>Now, let's dive into some tips for managing your daily expenses:</p>
                <ul>
                    <li><span class="text-small-bold">Track your spending: </span> Keep receipts, use budgeting apps, or create a simple spreadsheet to monitor where your money goes. Awareness is the first step to making changes.</li>
                    <li><span class="text-small-bold">Set realistic goals: </span>Start small by cutting back on unnecessary spending. Aim for achievable targets to stay motivated.</li>
                    <li><span class="text-small-bold">Embrace free entertainment: </span> Explore parks, libraries, or free local events for fun without breaking the bank.</li>
                    <li><span class="text-small-bold">Plan your meals: </span> Meal prepping or planning grocery lists can prevent impulse purchases at the store.</li>
                    <li><span class="text-small-bold">Utilize discounts: </span>Look for coupons, student discounts, or happy hour deals to save on everyday purchases.</li>
                    <li><span class="text-small-bold">Embrace alternatives:  </span> Consider cheaper alternatives for some expenses. For example, make coffee at home instead of buying it daily.</li>
                </ul>
                <p>By following these tips and tracking your progress, you can gain control of your daily expenses and pave the way for a brighter financial future. Remember, small changes can lead to big results!</p>
            </div>
        </div>
    </div>
</section>















<?php 
    include('Layout/footer.php');
    }else { header('location: index.php'); } ;
?>