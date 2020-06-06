<template>
    <div class="jumbotron bg-white">
    <h1 class="display-4">Unauthorized!</h1>
    <p class="lead">Your are trying to access Unauthorized content</p>
    <hr class="my-4">
    <p>Please contact Adminstrator for any queries related to your account.</p>
    <p class="lead">
        <router-link :to="{ name: 'home-page'}">
            <button class="btn btn-primary btn-lg">Back to Home</button>
        </router-link>
    </p>
    </div>
</template>