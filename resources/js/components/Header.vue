<template>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="#" class="active">Home</a>
                </li>
                <li>
                    <a href="#">Blog</a>
                </li>
                <li>
                    <a href="#">Chi Siamo</a>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style lang="scss" scoped>
    header {
        text-align: center;
        margin-top: 30px;

        li {
            display: inline-block;

            a {
                color: black;
                font-size: 18px;
                text-decoration: none;
                padding: 5px 10px;

                &.active,
                &:hover {
                    background-color: lightblue;
                }
            }
        }
    }
</style>