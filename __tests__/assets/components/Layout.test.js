import renderer from 'react-test-renderer'
import Layout from '../../../assets/components/Layout'

describe('<Layout>', function () {
  it('renders children in div', function () {
    const component = renderer.create(<Layout><span /></Layout>)
    const tree = component.toJSON()
    expect(tree).toMatchSnapshot()
  })
})
