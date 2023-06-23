<template>
  <router-view />
</template>

<style lang="scss">
  @import 'scss/main.scss';

  #app {
    font-family: 'Source Sans Pro', Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
  }

  body {
    margin: 0;
  }
  .el-table , .el-table thead, .el-table tr , .el-table thead tr, .el-table th.el-table__cell, .el-table--enable-row-hover .el-table__body tr:hover>td.el-table__cell{
    background-color: unset!important;
    color: unset!important;
  }
</style>
