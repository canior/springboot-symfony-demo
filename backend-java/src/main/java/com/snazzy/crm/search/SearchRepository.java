package com.snazzy.crm.search;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;

import java.util.List;

public interface SearchRepository<T, S extends Search> {
    List<T> search(S search);

    List<T> search(S search, Pageable pageable);

    Long getTotal(S search);
}
