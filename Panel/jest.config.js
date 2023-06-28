module.exports = {
  extensionsToTreatAsEsm: ['.ts'],
  transform: {
    '^.+\\.vue$': '@vue/vue3-jest',
    '^.+\\.js$': 'babel-jest'
  }
};
