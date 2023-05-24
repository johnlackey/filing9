import renderer from 'react-test-renderer'
import ItemList from '../../../assets/pages/ItemList'
import { MemoryRouter } from 'react-router-dom'

describe('<ItemList>', function () {
  it('renders ItemList', () => {
    const component = renderer.create(<MemoryRouter initialEntries={['/']}><ItemList /></MemoryRouter>)
    const tree = component.toJSON()
    expect(tree).toMatchSnapshot()
  })
})
