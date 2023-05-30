import React from 'react'
import { render, screen, fireEvent, waitFor } from '@testing-library/react'
import '@testing-library/jest-dom'
import axios from 'axios'
import ItemList from '../../../assets/pages/ItemList'
import { MemoryRouter } from 'react-router-dom'
import Swal from 'sweetalert2'

jest.mock('axios')

describe('ItemList', () => {
  beforeEach(() => {
    axios.get.mockResolvedValue({
      data: [
        { id: 1, location: 'Location 1', number: 'Number 1' },
        { id: 2, location: 'Location 2', number: 'Number 2' }
      ]
    })
  })

  afterEach(() => {
    jest.clearAllMocks()
  })

  it('fetches and renders items', async () => {
    render(<MemoryRouter initialEntries={['/']}><ItemList /></MemoryRouter>)

    await waitFor(() => {
      expect(screen.getByText('Location 1')).toBeInTheDocument()
      expect(screen.getByText('Number 1')).toBeInTheDocument()
      expect(screen.getByText('Location 2')).toBeInTheDocument()
      expect(screen.getByText('Number 2')).toBeInTheDocument()
    })
  })

  it('calls the delete function when delete button is clicked', async () => {
    axios.delete.mockResolvedValueOnce({})
    Swal.fire.mockResolvedValue({ isConfirmed: true })

    render(<MemoryRouter initialEntries={['/']}><ItemList /></MemoryRouter>)

    await waitFor(() => {
      const deleteButton = screen.getAllByRole('button', { name: /delete/i })[0]
      fireEvent.click(deleteButton)
    })

    expect(Swal.fire).toBeCalled()
    expect(axios.delete).toHaveBeenCalledTimes(1)
    expect(axios.delete).toHaveBeenCalledWith('/api/item/1')
  })

  // Add more test cases as needed...
})
