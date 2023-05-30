import React, { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import Layout from '../components/Layout'
import Swal from 'sweetalert2'
import axios from 'axios'

function ItemList () {
  const [itemList, setItemList] = useState([])

  useEffect(() => {
    fetchItemList()
  }, [])

  const fetchItemList = () => {
    axios.get('/api/item')
      .then(function (response) {
        setItemList(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  const handleDelete = (id) => {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        axios.delete(`/api/item/${id}`)
          .then(function (response) {
            Swal.fire({
              icon: 'success',
              title: 'Item deleted successfully!',
              showConfirmButton: false,
              timer: 1500
            })
            fetchItemList()
          })
          .catch(function (error) {
            console.log('Error: ', error)
            Swal.fire({
              icon: 'error',
              title: 'An Error Occurred!',
              showConfirmButton: false,
              timer: 1500
            })
          })
      }
    })
  }

  return (
    <Layout>
      <div className='container'>
        <h2 className='text-center mt-5 mb-3'>Symfony Item Manager</h2>
        <div className='card'>
          <div className='card-header'>
            <Link to='/create' className='btn btn-outline-primary'>
              Create New Item
            </Link>
          </div>
          <div className='card-body'>
            <table className='table table-bordered'>
              <thead>
                <tr>
                  <th>Location</th>
                  <th>Number</th>
                  <th width='240px'>Action</th>
                </tr>
              </thead>
              <tbody>
                {itemList.map((item, key) => {
                  return (
                    <tr key={key}>
                      <td>{item.location}</td>
                      <td>{item.number}</td>
                      <td>
                        <Link
                          to={`/show/${item.id}`}
                          className='btn btn-outline-info mx-1'
                        >
                          Show
                        </Link>
                        <Link
                          className='btn btn-outline-success mx-1'
                          to={`/edit/${item.id}`}
                        >
                          Edit
                        </Link>
                        <button
                          onClick={() => handleDelete(item.id)}
                          className='btn btn-outline-danger mx-1'
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  )
                })}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </Layout>
  )
}

export default ItemList
