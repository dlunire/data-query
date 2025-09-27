import { getComponent, type Route, route } from './sources/generator';

import Home from '../pages/home/Home.svelte';
import Install from '../pages/Install.svelte';
import Check from '../pages/Check.svelte';

export const routes: Route[] = [
    route('/', getComponent(Home), []),
    route('/install/credentials', getComponent(Install), []),
    route('/credentials/check', getComponent(Check), []),
];
