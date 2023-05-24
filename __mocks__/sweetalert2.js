const sweetalert2 = jest.genMockFromModule('sweetalert2')
sweetalert2.fire = jest.fn()
module.exports = sweetalert2
