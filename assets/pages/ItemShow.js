import React, { useState, useEffect } from 'react'
import { Link, useParams } from 'react-router-dom'
import Layout from '../components/Layout'
import axios from 'axios'

function ItemShow () {
  // eslint-disable-next-line no-unused-vars
  const [id, setId] = useState(useParams().id)
  const [item, setItem] = useState({ name: '', description: '' })
  useEffect(() => {
    axios.get(`/api/item/${id}`)
      .then(function (response) {
        setItem(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }, [])

  return (
    <Layout>
      <div className='container'>
        <h2 className='text-center mt-5 mb-3'>Show Item</h2>
        <div className='card'>
          <div className='card-header'>
            <Link
              className='btn btn-outline-info float-right'
              to='/'
            > View All Items
            </Link>
          </div>
          <div className='card-body'>
            <b className='text-muted'>Name:</b>
            <p>{item.name}</p>
            <b className='text-muted'>Description:</b>
            <p>{item.description}</p>
          </div>
        </div>
      </div>
    </Layout>
  )
}

export default ItemShow
