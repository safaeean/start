import { createApp } from 'vue';
import { mount } from '@vue/test-utils';
import App from '../src/App.vue';

describe('App.vue', () => {
  it('renders without errors', () => {
    const app = createApp(App);
    const wrapper = mount(app);
    expect(wrapper.exists()).toBe(true);
  });
});
