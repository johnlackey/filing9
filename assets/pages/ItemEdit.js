import React, { useState, useEffect } from 'react'
import { Link, useParams } from 'react-router-dom'
import Layout from '../components/Layout'
import Swal from 'sweetalert2'
import axios from 'axios'

function ItemEdit () {
  // eslint-disable-next-line no-unused-vars
  const [id, setId] = useState(useParams().id)
  const [name, setName] = useState('')
  const [description, setDescription] = useState('')
  const [isSaving, setIsSaving] = useState(false)

  useEffect(() => {
    axios.get(`/api/item/${id}`)
      .then(function (response) {
        const item = response.data
        setName(item.name)
        setDescription(item.description)
      })
      // eslint-disable-next-line n/handle-callback-err
      .catch(function (error) {
        Swal.fire({
          icon: 'error',
          title: 'An Error Occured!',
          showConfirmButton: false,
          timer: 1500
        })
      })
  }, [])

  const handleSave = () => {
    setIsSaving(true)
    axios.patch(`/api/item/${id}`, {
      name,
      description
    })
      .then(function (response) {
        Swal.fire({
          icon: 'success',
          title: 'Item updated successfully!',
          showConfirmButton: false,
          timer: 1500
        })
        setIsSaving(false)
      })
      // eslint-disable-next-line n/handle-callback-err
      .catch(function (error) {
        Swal.fire({
          icon: 'error',
          title: 'An Error Occurred!',
          showConfirmButton: false,
          timer: 1500
        })
        setIsSaving(false)
      })
  }

  return (
    <Layout>
      <div className='container'>
        <h2 className='text-center mt-5 mb-3'>Edit Item</h2>
        <div className='card'>
          <div className='card-header'>
            <Link
              className='btn btn-outline-info float-right'
              to='/'
            >View All Items
            </Link>
          </div>
          <div className='card-body'>
            <form>
              <div className='form-group'>
                <label htmlFor='name'>Name</label>
                <input
                  onChange={(event) => { setName(event.target.value) }}
                  value={name}
                  type='text'
                  className='form-control'
                  id='name'
                  name='name'
                />
              </div>
              <div className='form-group'>
                <label htmlFor='description'>Description</label>
                <textarea
                  value={description}
                  onChange={(event) => { setDescription(event.target.value) }}
                  className='form-control'
                  id='description'
                  rows='3'
                  name='description'
                />
              </div>
              <button
                disabled={isSaving}
                onClick={handleSave}
                type='button'
                className='btn btn-outline-success mt-3'
              >
                Update Item
              </button>
            </form>
          </div>
        </div>
      </div>
    </Layout>
  )
}

export default ItemEdit
