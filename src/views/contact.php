<!--  -->
<?php if(isset($sent) && $sent === true) :?>
    <div class="contact--success">
        <h3>Thank you! We'll be in touch.</h3>
        <a href="/" class="link">Back to home</a>
    </div>
<?php else: ?>

<div class="contact">
<h1>Contact</h1>
<form action="" method="post">
<div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name" id="name"
        value ="<?php echo isset($_POST['name']) ? $name : '';?>">
    </div>
<div class="form-group">
        <label for="">Email address</label>
        <input type="email" name="email" id="email" 
            value ="<?php echo isset($_POST['email']) ? $email : '';?>">
    </div>
    <div class="form-group">
        <label for="">Subject</label>
        <input type="text" name="subject" id="subject"
        value ="<?php echo isset($_POST['subject']) ? $subject : '';?>">
        
    </div>

    <div class="form-group">
        <label for="">Body</label>
        <textarea name="body" id="body"><?php echo isset($_POST['body']) ? $body : '';?></textarea>
    </div>

    <?php if(isset($msg) && $msg != '') :?>
    <div class="alert <?=$msgClass;?>"><?=$msg;?></div>

    <?php endif; ?>

    <div class="form-action">
    <button type="submit" class="btn btn-contact">Submit</button>
    </div>

</form>

</div>

<?php endif ; ?>