<template>
    <div>
    <!-- reviewsList -->
    <ul class="list-unstyled reviewsList">
        <li>
            <div class="alignleft">
                <a href="instructor-single.html"><img src="http://placehold.it/50x50" alt="Lavin Duster"></a>
            </div>
            <div class="description-wrap">
                <div class="descrHead">
                    <h3>Lavin Duster – <time datetime="2011-01-12">March 7, 2016</time></h3>
                    <ul class="star-rating list-unstyled justify-end">
                        <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                        <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                        <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                        <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                        <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                    </ul>
                </div>
                <p class="text-muted">Brunch fap cardigan, gentrify put a bird on it distillery mumblecore you probably haven't heard of them asymmetrical bushwick. Put a bird on it schlitz fashion.</p>
            </div>
        </li>
    </ul>
    <!-- reviesSubmissionForm -->
    <form action="#" class="reviesSubmissionForm">
        <h2 class="text-noCase h4">Add a Review</h2>
        <p>Your email address will not be published. Required fields are marked <span class="required">*</span></p>
        <div class="form-group">
            <span class="formLabel fw-normal font-lato no-shrink">Your Rating</span>
            <ul class="star-rating list-unstyled">
                <li>
                    <input type="checkbox" id="rate1" class="customFormReset">
                    <label for="rate1" class="fas fa-star"><span class="sr-only">star</span></label>
                </li>
                <li>
                    <input type="checkbox" id="rate2" class="customFormReset">
                    <label for="rate2" class="fas fa-star"><span class="sr-only">star</span></label>
                </li>
                <li>
                    <input type="checkbox" id="rate3" class="customFormReset">
                    <label for="rate3" class="fas fa-star"><span class="sr-only">star</span></label>
                </li>
                <li>
                    <input type="checkbox" id="rate4" class="customFormReset">
                    <label for="rate4" class="fas fa-star"><span class="sr-only">star</span></label>
                </li>
                <li>
                    <input type="checkbox" id="rate5" class="customFormReset">
                    <label for="rate5" class="fas fa-star"><span class="sr-only">star</span></label>
                </li>
            </ul>
        </div>
        <div class="form-group">
            <label for="rview" class="formLabel fw-normal font-lato no-shrink">Your Review <span class="required">*</span></label>
            <textarea id="rview" class="form-control element-block"></textarea>
        </div>
        <div class="form-group">
            <label for="name" class="formLabel fw-normal font-lato no-shrink">Name <span class="required">*</span></label>
            <input type="text" id="name" class="form-control element-block">
        </div>
        <div class="form-group">
            <label for="Email" class="formLabel fw-normal font-lato no-shrink">Email <span class="required">*</span></label>
            <input type="email" id="Email" class="form-control element-block">
        </div>
        <button type="submit" class="btn btn-theme btn-warning text-uppercase font-lato fw-bold">Submit</button>
    </form>
    </div>
</template>

<script>
export default {
    
}
</script>
        